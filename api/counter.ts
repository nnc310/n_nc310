import { kv } from '@vercel/kv';
import type { VercelRequest, VercelResponse } from '@vercel/node';

export default async function handler(req: VercelRequest, res: VercelResponse) {
  // カウントを1増やす
  const count = await kv.incr('visitor_count');
  // 数字を返す
  res.status(200).json({ count });
}