// @ts-nocheck
import { NextResponse, NextRequest } from 'next/server';
import { PrismaClient } from '@prisma/client';

const prisma = new PrismaClient();

export async function GET(
  request: NextRequest,
  context: { params: { slug: string } }
) {
  try {
    const { slug } = context.params;
    const cat = await prisma.cat.findUnique({
      where: {
        slug: slug,
      },
      include: {
        blogs: true,
      },
    });
    if (!cat) {
      return NextResponse.json({ error: 'Category not found' }, { status: 404 });
    }

    const responseData = {
      id: cat.id,
      name: cat.name,
      slug: cat.slug,
      blogs: cat.blogs.map(blog => ({
        id: blog.id,
        title: blog.title,
        slug: blog.slug,
        createdAt: blog.createdAt,
      })),
    };

    return NextResponse.json(responseData);
  } catch (error) {
    console.error('Error fetching category:', error);
    return NextResponse.json({ error: 'Failed to fetch category' }, { status: 500 });
  }
}
