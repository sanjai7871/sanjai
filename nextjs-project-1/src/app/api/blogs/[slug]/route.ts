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
    const blog = await prisma.blog.findUnique({
      where: {
        slug: slug,
      },
      include: {
        cats: true,
        tags: true,
      },
    });
    if (!blog) {
      return NextResponse.json({ error: 'Blog not found' }, { status: 404 });
    }

    const responseData = {
      id: blog.id,
      title: blog.title,
      slug: blog.slug,
      content: blog.content,
      createdAt: blog.createdAt,
      cats: blog.cats,
      tags: blog.tags.map(tag => ({
        id: tag.id,
        name: tag.name,
        slug: tag.slug,
      })),
    };

    return NextResponse.json(responseData);
  } catch (error) {
    console.error('Error fetching blog:', error);
    return NextResponse.json({ error: 'Failed to fetch blog' }, { status: 500 });
  }
}
