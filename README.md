# Full-Stack Personal Portfolio (የግል ፖርትፎሊዮ የሶፍትዌር ኢንጂነሪንግ ፕሮጀክት)

በ**Laravel 11** (Backend API), **Vue.js 3 + Vite** (Frontend SPA), **Tailwind CSS** (Dark Mode / Glassmorphism) እና **MySQL 8** (Database) የተገነባ ዘመናዊ፣ ከፍተኛ ፍጥነት ያለው እና ደህንነቱ የተጠበቀ የግል ፖርትፎሊዮ።

---

## 🚀 ዋና ዋና ባህሪያት (Key Features)

1. **Zero Hardcoding (ሁሉም መረጃዎች ከዳታቤዝ በቀጥታ የሚመጡ)**
   - ፕሮጀክቶች (Projects & Case Studies)
   - የቴክኖሎጂ ክህሎቶች (Tech Stack Grid)
   - የህይወት ታሪክ እና ልምድ (Career & Education Journey)
   - ስታቲስቲክስ (Interactive Counters: 50+ Projects, 99.9% Uptime, 5+ Years Experience)
   - ማህበራዊ አውታሮች እና አድራሻዎች (Email, GitHub, LinkedIn, Telegram, X)

2. **ተጠቃሚ-ተኮር ገጽታ (UI/UX - Based on Provided Screenshots)**
   - **Hero Section (Screenshot 3 & 2)**: የመግቢያ ገጽ ከሳይበርፓንክ አይዲኢ ኮድ እና አቫታር ጋር።
   - **Tech Stack Grid (Screenshot 2)**: ቴክኖሎጂዎችን በምድብ (Backend, Frontend, Database, Tools) የሚያሳይ።
   - **Featured Projects & Reactive Filtering (Screenshot 2 & FR-01)**: ፕሮጀክቶችን ያለ ገጽ መጫን (instant reactive filtering) ማጣራት።
   - **Case Study Modal (Screenshot 2 & FR-02)**: የተፈታው ችግር (Problem Solved)፣ የስርዓት አርክቴክቸር፣ የዳታቤዝ ግንኙነት፣ የቀጥታ ማሳያ (Live Demo) እና GitHub ሊንኮች።
   - **About Me & Journey Timeline (Screenshot 4)**: በኒዮን ፍሬም የተከበበ ፎቶ፣ የስራ ልምድ እና የትምህርት ጉዞ የጊዜ ሰሌዳ።
   - **Hire Me & Contact (Screenshot 1 & FR-03/FR-04)**: 2x2 የመገናኛ ካርዶች እና ፈጣን የመልዕክት መላኪያ ፎርም (በቀጥታ ወደ MySQL ዳታቤዝ የሚገባ)።
   - **Download CV (FR-06)**: በአንድ ክሊክ የገንቢውን ሙያዊ ሲቪ (PDF) ማውረድ።
   - **Admin Management Portal (FR-05)**: በLaravel Sanctum ደህንነቱ በተጠበቀ ቶከን አዳዲስ ፕሮጀክቶችን መመዝገብ፣ ማስተካከል፣ ማጥፋት እና የመጡ መልዕክቶችን ማንበብ።

---

## 🛠️ የቴክኖሎጂ ቁልሎች (Tech Stack)

- **Backend**: Laravel 11.x, PHP 8.x, Laravel Sanctum (Token Auth)
- **Frontend**: Vue.js 3 (Composition API), Vite, Tailwind CSS, Axios
- **Database**: MySQL 8.0 / MariaDB (Database Name: `portfolio_db`)
- **Testing**: PHPUnit / Pest (8 Automated API Feature Tests - 100% Passed)

---

## 💻 ፕሮጀክቱን ለማስኬድ (How to Run Locally)

### 1. ዳታቤዝ (Database Setup)
MySQL ሰርቨር መብራቱን ያረጋግጡ (XAMPP / MySQL Service port 3306)። ዳታቤዙ `portfolio_db` ነው።

### 2. የባክኤንድ አገልጋይ ማስኬድ (Run Laravel Backend)
```bash
cd Backend
php artisan serve --port=8000
```
- የኤፒአይ መዳረሻ: `http://127.0.0.1:8000/api/v1`

### 3. የፍሮንት-ኤንድ አገልጋይ ማስኬድ (Run Vue Frontend)
```bash
cd Frontend
npm run dev
```
- የተጠቃሚ ገጽታ መክፈቻ: `http://localhost:5173`

---

## 🔐 የአስተዳዳሪ መግቢያ (Admin Credentials)

- **ኢሜይል (Email)**: `admin@portfolio.com`
- **የይለፍ ቃል (Password)**: `Password123!`
- የመግቢያ አዝራሩ በገጹ የላይኛው ቀኝ ክፍል (Navbar) ላይ **Admin** ተብሎ ይገኛል።

---

## 🧪 ቴስቶችን ለማስኬድ (Running Automated Tests)

```bash
cd Backend
php artisan test --filter=PortfolioApiTest
```
- 8 tests passed (50 assertions, 0 failures).
