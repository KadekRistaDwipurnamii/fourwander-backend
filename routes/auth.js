import express from "express";
import bcrypt from "bcrypt";
import jwt from "jsonwebtoken";
import fs from "fs";

const router = express.Router();
const SECRET = "fourwander-secret";

// read database
const readDB = () => JSON.parse(fs.readFileSync("database.json"));
const writeDB = (data) =>
  fs.writeFileSync("database.json", JSON.stringify(data, null, 2));

// REGISTER
router.post("/register", async (req, res) => {
  const { name, email, password } = req.body;

  const db = readDB();
  const exist = db.users.find((u) => u.email === email);

  if (exist) return res.status(400).json({ message: "Email already used" });

  const hashed = await bcrypt.hash(password, 10);

  db.users.push({ id: Date.now(), name, email, password: hashed });
  writeDB(db);

  res.json({ message: "Register success" });
});

// LOGIN
router.post("/login", async (req, res) => {
  const { email, password } = req.body;

  const db = readDB();
  const user = db.users.find((u) => u.email === email);

  if (!user) return res.status(400).json({ message: "User not found" });

  const match = await bcrypt.compare(password, user.password);
  if (!match) return res.status(400).json({ message: "Wrong password" });

  const token = jwt.sign({ id: user.id, email }, SECRET, { expiresIn: "7d" });

  res.json({ token, user });
});

export default router;
