import { Redis } from '@upstash/redis';
import type { VercelRequest, VercelResponse } from '@vercel/node';

// SDKの初期化（環境変数から自動で読み込みます）
const redis = Redis.fromEnv();

export default async function handler(req: VercelRequest, res: VercelResponse) {
  try {
    // カウントを1増やす
    const count = await redis.incr('visitor_count');
    res.status(200).json({ count });
  } catch (error) {
    res.status(500).json({ error: "Redis接続エラー" });
  }
}