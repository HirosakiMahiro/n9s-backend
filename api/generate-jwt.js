import jwt from "jsonwebtoken";

export default function handler(req, res) {
  if (req.method !== "POST") {
    return res.status(405).json({ error: "Method not allowed" });
  }

  const { user_id } = req.body;

  if (!user_id) {
    return res.status(400).json({ error: "user_id missing" });
  }

  const SECRET = "SuperSecretKey_ChangeMe123!";  // замени при желании
  const APP_ID = "app_zF1BHmYti2oRMyGf";
  const ORG_ID = "198";

  const token = jwt.sign(
    {
      app_id: APP_ID,
      organization_id: ORG_ID,
      user_id: user_id
    },
    SECRET,
    { expiresIn: "1h" }
  );

  res.status(200).json({
    token,
    user_id
  });
}