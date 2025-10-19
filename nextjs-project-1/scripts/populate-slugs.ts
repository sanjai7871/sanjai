import { PrismaClient } from '@prisma/client';

const prisma = new PrismaClient();

function slugify(text: string): string {
  return text
    .toString()
    .toLowerCase()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
}

async function main() {
  console.log('Starting to populate slugs for existing entries...');

  // Populate blog slugs
  const blogs = await prisma.blog.findMany({ where: { slug: null } });
  for (const blog of blogs) {
    const newSlug = slugify(blog.title);
    // In case of duplicate slugs, append the ID to ensure uniqueness
    const existing = await prisma.blog.findUnique({ where: { slug: newSlug } });
    const finalSlug = existing ? `${newSlug}-${blog.id}` : newSlug;
    await prisma.blog.update({
      where: { id: blog.id },
      data: { slug: finalSlug },
    });
    console.log(`Updated blog "${blog.title}" with slug: ${finalSlug}`);
  }

  // Populate cat slugs
  const cats = await prisma.cat.findMany({ where: { slug: null } });
  for (const cat of cats) {
    const newSlug = slugify(cat.name);
    const existing = await prisma.cat.findUnique({ where: { slug: newSlug } });
    const finalSlug = existing ? `${newSlug}-${cat.id}` : newSlug;
    await prisma.cat.update({
      where: { id: cat.id },
      data: { slug: finalSlug },
    });
     console.log(`Updated cat "${cat.name}" with slug: ${finalSlug}`);
  }

  // Populate tag slugs
  const tags = await prisma.tag.findMany({ where: { slug: null } });
  for (const tag of tags) {
    const newSlug = slugify(tag.name);
    const existing = await prisma.tag.findUnique({ where: { slug: newSlug } });
    const finalSlug = existing ? `${newSlug}-${tag.id}` : newSlug;
    await prisma.tag.update({
      where: { id: tag.id },
      data: { slug: finalSlug },
    });
    console.log(`Updated tag "${tag.name}" with slug: ${finalSlug}`);
  }

  console.log('Finished populating slugs.');
}

main()
  .catch((e) => {
    console.error(e);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
