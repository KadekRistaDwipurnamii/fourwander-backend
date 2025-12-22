import express from "express";
import fs from "fs";
import jwt from "jsonwebtoken";

const router = express.Router();
const SECRET = "fourwander-secret";

const readDB = () => JSON.parse(fs.readFileSync("database.json"));
const writeDB = (data) =>
  fs.writeFileSync("database.json", JSON.stringify(data, null, 2));

// Middleware verify token
const verify = (req, res, next) => {
  const token = req.headers.authorization?.split(" ")[1];
  if (!token) return res.status(401).json({ message: "No token" });
  try {
    req.user = jwt.verify(token, SECRET);
    next();
  } catch {
    return res.status(401).json({ message: "Invalid token" });
  }
};

// BOOKING
router.post("/", verify, (req, res) => {
  const db = readDB();

  const booking = {
    id: Date.now(),
    userId: req.user.id,
    ...req.body,
  };

  db.bookings.push(booking);
  writeDB(db);

  res.json({ message: "Booking successful", booking });
});

export default router;
