import { NextResponse } from 'next/server';
import { PrismaClient } from '@prisma/client';

const prisma = new PrismaClient();

export async function GET() {
  try {
    const cats = await prisma.cat.findMany({
      include: {
        blogs: true,
      },
    });

    const responseData = cats.map(cat => ({
      id: cat.id,
      name: cat.name,
      blogs: cat.blogs.map(blog => ({
        id: blog.id,
        title: blog.title,
        createdAt: blog.createdAt,
      })),
    }));

    return NextResponse.json(responseData);
  } catch (error) {
    console.error('Error fetching categories:', error);
    return NextResponse.json({ error: 'Failed to fetch categories' }, { status: 500 });
  }
}
