import { NextResponse } from 'next/server';
import { PrismaClient } from '@prisma/client';

const prisma = new PrismaClient();

export async function GET() {
  try {
    const blogs = await prisma.blog.findMany({
      include: {
        cats: true,
        tags: true,
      },
    });

    const responseData = blogs.map(blog => ({
      id: blog.id,
      title: blog.title,
      content: blog.content,
      createdAt: blog.createdAt,
      cats: blog.cats, // Assuming 'cats' does not have a back-reference to blogs
      tags: blog.tags.map(tag => ({
        id: tag.id,
        name: tag.name,
      })),
    }));

    return NextResponse.json(responseData);
  } catch (error) {
    console.error('Error fetching blogs:', error);
    return NextResponse.json({ error: 'Failed to fetch blogs' }, { status: 500 });
  }
}
