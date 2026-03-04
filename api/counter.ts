import { Redis } from '@upstash/redis';
import type { VercelRequest, VercelResponse } from '@vercel/node';

// 直接貼り付ける（' ' で囲むのを忘れずに）
const redis = new Redis({
  url: 'https://sincere-swine-63353.upstash.io',
  token: 'Afd5AAIncDJmMThlMzBiNzQzOTE0NmVlOTRmZWRmZGNiMTJmMTBlZXAyNjMzNTM',
});

export default async function handler(req: VercelRequest, res: VercelResponse) {
  try {
    const count = await redis.incr('visitor_count');
    res.status(200).json({ count });
  } catch (error) {
    console.error(error);
    res.status(500).json({ error: "接続エラー" });
  }
}