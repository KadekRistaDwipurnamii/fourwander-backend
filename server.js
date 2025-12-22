import express from "express";
import cors from "cors";
import bodyParser from "body-parser";
import authRoute from "./routes/auth.js";
import bookingRoute from "./routes/booking.js";

const app = express();
app.use(cors());
app.use(bodyParser.json());

// routes
app.use("/auth", authRoute);
app.use("/booking", bookingRoute);

app.listen(5000, () => console.log("Backend running on port 5000"));
