const { PrismaClient } = require('@prisma/client');
const mysql = require('mysql2/promise');

const prisma = new PrismaClient();

async function main() {
  const wordpressDb = await mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: 'onfra_wordpress',
  });

  const [posts] = await wordpressDb.execute(`
    SELECT p.ID, p.post_title, p.post_name, p.post_content, p.post_date, p.post_modified
    FROM wpsw_posts p
    WHERE p.post_type = 'post' AND p.post_status = 'publish'
  `);

  for (const post of posts as any[]) {
    // Get Featured Image
    const [thumbnailIdResult] = await wordpressDb.execute(`
      SELECT meta_value FROM wpsw_postmeta WHERE post_id = ? AND meta_key = '_thumbnail_id'
    `, [post.ID]);
    const thumbnailId = (thumbnailIdResult as any[])[0]?.meta_value;
    let featureImg = null;
    if (thumbnailId) {
      const [attachmentResult] = await wordpressDb.execute(`
        SELECT guid FROM wpsw_posts WHERE ID = ?
      `, [thumbnailId]);
      featureImg = (attachmentResult as any[])[0]?.guid;
    }

    // Get Terms (Categories and Tags)
    const [terms] = await wordpressDb.execute(`
      SELECT t.*, tt.taxonomy
      FROM wpsw_term_relationships tr
      JOIN wpsw_term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
      JOIN wpsw_terms t ON tt.term_id = t.term_id
      WHERE tr.object_id = ?
    `, [post.ID]);

    const categories = (terms as any[]).filter(term => term.taxonomy === 'category');
    const tags = (terms as any[]).filter(term => term.taxonomy === 'post_tag');

    const miniContent = post.post_content.replace(/<[^>]*>?/gm, '');

    const createdBlog = await prisma.blog.create({
      data: {
        title: post.post_title,
        slug: post.post_name,
        content: post.post_content,
        mini_content: miniContent,
        feature_img: featureImg,
        max: 20,
        createdAt: post.post_date,
        updatedAt: post.post_modified,
        cats: {
          connectOrCreate: categories.map(cat => ({
            where: { name: cat.name },
            create: { name: cat.name, slug: cat.slug },
          })),
        },
        tags: {
          connectOrCreate: tags.map(tag => ({
            where: { name: tag.name },
            create: { name: tag.name, slug: tag.slug },
          })),
        },
      },
    });

    console.log(`Created blog: ${createdBlog.title}`);
  }

  await wordpressDb.end();
}

main()
  .catch((e) => {
    console.error(e);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
