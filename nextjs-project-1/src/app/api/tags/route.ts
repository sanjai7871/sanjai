import { NextResponse } from 'next/server';
import { PrismaClient } from '@prisma/client';

const prisma = new PrismaClient();

export async function GET() {
  try {
    const tags = await prisma.tag.findMany({
      include: {
        blogs: true, // Fetch the related blogs
      },
    });

    // --- SOLUTION: Manually construct the response to avoid circular references ---
    const responseData = tags.map(tag => ({
      id: tag.id,
      name: tag.name,
      // From the blogs array, only take the data you need
      // This removes the back-reference to the tag itself
      blogs: tag.blogs.map(blog => ({
        id: blog.id,
        title: blog.title,
        createdAt: blog.createdAt,
      })),
    }));

    return NextResponse.json(responseData);
  } catch (error) {
    console.error('Error fetching tags:', error);
    return NextResponse.json({ error: 'Failed to fetch tags' }, { status: 500 });
  }
}
