# User Login and Quiz Application

This application is built using **Laravel** as the backend and **Vue.js** as the frontend. It provides a simple user login system, a countdown timer for exams, and a quiz system with multiple-choice and short-answer questions.

## Features

- **User Login**: Users can log in with a username and password.
- **EXAM-1 Card**: After logging in, the user sees a card labeled “EXAM-1”. Upon clicking, the exam starts.
- **Countdown Timer**: A 10-minute countdown starts when the user clicks the EXAM-1 card.
- **Quiz**: The user is shown a quiz with multiple-choice questions (radio buttons) and short-answer input fields.
- **Results**: After submitting the quiz, the user sees the results with correct answers.

## Project Structure

```plaintext
BARC/
├── admin/                # Laravel Backend
│   ├── app/
│   ├── routes/
│   ├── database/
│   ├── .env
│   └── artisan
├── frontend/               # Vue.js 
│   ├── public/
│   ├── src/
│   │   ├── assets/
│   │   ├── components/
│   │   │   ├── Login.vue
│   │   │   ├── ExamCard.vue
│   │   │   ├── CountdownTimer.vue
│   │   │   └── Quiz.vue
│   │   ├── views/
│   │   │   └── Home.vue
│   │   ├── App.vue
│   │   └── main.js
├── package.json            # Vue.js dependencies
├── backend/package.json    # Laravel and backend dependencies
└── README.md
