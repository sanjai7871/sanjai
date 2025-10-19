import { NextResponse } from 'next/server';
import { PrismaClient } from '@prisma/client';

const prisma = new PrismaClient();

export async function GET() {
  try {
    const caseStudies = await prisma.caseStudy.findMany();
    return NextResponse.json(caseStudies);
  } catch (error) {
    console.error('Error fetching case studies:', error);
    return NextResponse.json({ error: 'Failed to fetch case studies' }, { status: 500 });
  }
}
