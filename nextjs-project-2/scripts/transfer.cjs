const { PrismaClient } = require('@prisma/client');
const mysql = require('mysql2/promise');

const prisma = new PrismaClient();

async function main() {
  console.log('Connecting to WordPress database...');
  const wordpressDb = await mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: 'onfra_wordpress',
  });
  console.log('Connected to WordPress database.');

  console.log('Fetching posts...');
  const [posts] = await wordpressDb.execute(`
    SELECT p.ID, p.post_title, p.post_content, p.post_date, p.post_modified
    FROM wpsw_posts p
    WHERE p.post_type = 'post' AND p.post_status = 'publish'
  `);
  console.log(`Found ${posts.length} posts to transfer.`);

  for (const post of posts) {
    console.log(`Processing post: ${post.post_title}`);
    const [terms] = await wordpressDb.execute(`
      SELECT t.*, tt.taxonomy
      FROM wpsw_term_relationships tr
      JOIN wpsw_term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
      JOIN wpsw_terms t ON tt.term_id = t.term_id
      WHERE tr.object_id = ?
    `, [post.ID]);

    const categories = terms.filter(term => term.taxonomy === 'category');
    const tags = terms.filter(term => term.taxonomy === 'post_tag');

    const createdBlog = await prisma.blog.create({
      data: {
        title: post.post_title,
        content: post.post_content,
        createdAt: post.post_date,
        updatedAt: post.post_modified,
        cats: {
          connectOrCreate: categories.map(cat => ({
            where: { name: cat.name },
            create: { name: cat.name },
          })),
        },
        tags: {
          connectOrCreate: tags.map(tag => ({
            where: { name: tag.name },
            create: { name: tag.name },
          })),
        },
      },
    });

    console.log(`  -> Transferred blog: ${createdBlog.title}`);
  }

  await wordpressDb.end();
  console.log('Data transfer complete.');
}

main()
  .catch((e) => {
    console.error('An error occurred during the transfer:', e);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
