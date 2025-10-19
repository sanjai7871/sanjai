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
    const tag = await prisma.tag.findUnique({
      where: {
        slug: slug,
      },
      include: {
        blogs: true,
      },
    });
    if (!tag) {
      return NextResponse.json({ error: 'Tag not found' }, { status: 404 });
    }

    const responseData = {
      id: tag.id,
      name: tag.name,
      slug: tag.slug,
      blogs: tag.blogs.map(blog => ({
        id: blog.id,
        title: blog.title,
        slug: blog.slug,
        createdAt: blog.createdAt,
      })),
    };

    return NextResponse.json(responseData);
  } catch (error) {
    console.error('Error fetching tag:', error);
    return NextResponse.json({ error: 'Failed to fetch tag' }, { status: 500 });
  }
}
