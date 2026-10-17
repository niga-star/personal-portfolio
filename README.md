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

2. **ተጠቃሚ-ተኮር ገጽታ (UI/UX - Based on Screenshots)**
   - **Hero Section**: የመግቢያ ገጽ ከሳይበርፓንክ አይዲኢ ኮድ እና አቫታር ጋር።
   - **Tech Stack Grid**: ቴክኖሎጂዎችን በምድብ (Backend, Frontend, Database, Tools) የሚያሳይ።
   - **Featured Projects & Reactive Filtering**: ፕሮጀክቶችን ያለ ገጽ መጫን (instant reactive filtering) ማጣራት።
   - **Case Study Modal**: የተፈታው ችግር (Problem Solved)፣ የስርዓት አርክቴክቸር፣ የዳታቤዝ ግንኙነት፣ የቀጥታ ማሳያ (Live Demo) እና GitHub ሊንኮች።
   - **About Me & Journey Timeline**: በኒዮን ፍሬም የተከበበ ፎቶ፣ የስራ ልምድ እና የትምህርት ጉዞ የጊዜ ሰሌዳ።
   - **Hire Me & Contact**: 2x2 የመገናኛ ካርዶች እና ፈጣን የመልዕክት መላኪያ ፎርም (በቀጥታ ወደ MySQL ዳታቤዝ የሚገባ)።
   - **Download CV**: በአንድ ክሊክ የገንቢውን ሙያዊ ሲቪ (PDF) ማውረድ።

3. **ጠንካራ የማረጋገጫ እና የደህንነት ስርዓት (Robust Authentication & Security)**
   - **Laravel Sanctum Bearer Token**: ለሁሉም የአስተዳዳሪ ኤፒአይዎች ደህንነቱ የተጠበቀ ቁልፍ።
   - **Brute-Force Rate Limiting**: በመግቢያው (`/api/v1/auth/login`) ላይ በደቂቃ ከ5 ሙከራ በላይ እንዳይደረግ መቆጣጠሪያ።
   - **Session Auto-Validation**: የአድሚን ሞዳል ሲከፈት የቶከኑን ትክክለኛነት በራስ-ሰር ማረጋገጥ።
   - **401 Unauthorized Interceptor**: ቶከን ሲያበቃ በቀጥታ ቶከኑን በማጽዳት ወደ መግቢያ ገጽ መመለስ።
   - **Change Password**: አስተዳዳሪው ነባሪውን የይለፍ ቃል በአዲስ ጠንካራ የይለፍ ቃል በደህንነት የሚቀይርበት ሙሉ በይነ-ገጽ።

4. **ጥራት ያለው የማጣሪያ ስርዓት (Comprehensive Two-Tier Validation)**
   - **Dedicated Laravel Form Requests**:
     - `LoginRequest`: የኢሜይል እና የይለፍ ቃል ማጣሪያ ከሁለት ቋንቋ (አማርኛ/እንግሊዝኛ) መልዕክቶች ጋር።
     - `ProjectRequest`: የርዕስ፣ ምድብ፣ ማጠቃለያ፣ መግለጫ እና ትክክለኛ URL ማጣሪያ።
     - `SkillRequest`: የክህሎት ስም (ተደጋጋፊ እንዳይሆን) እና የብቃት ደረጃ (1-100%) ማጣሪያ።
     - `ExperienceRequest`: የጊዜ ሰሌዳ፣ የስራ መደብ፣ ተቋም እና አይነት (career/education) ማጣሪያ።
     - `ProfileUpdateRequest`: የኢሜይል፣ የሊንኮች እና የስም ማጣሪያ።
     - `ChangePasswordRequest`: የነባር የይለፍ ቃል ትክክለኛነት እና የአዲሱ የይለፍ ቃል ጥንካሬ ማጣሪያ።
     - `ContactRequest`: የመልዕክት ርዝመት (ቢያንስ 10 ፊደላት) እና የኢሜይል ማጣሪያ።
   - **Client-Side Instant Validation & Inline Error Displays**: ተጠቃሚው የተሳሳተ መረጃ ሲያስገባ በቀይ መስመር እና ከሳጥኑ ስር በሚታዩ ግልጽ የስህተት መልዕክቶች ያሳውቃል።

5. **የተሟላ የአስተዳዳሪ ማስተዳደሪያ ፓነል (Full Admin Management Portal)**
   - **Messages**: የመጡ መልዕክቶችን ማንበብ፣ Mark Read ማድረግ እና ማጥፋት።
   - **Projects**: አዲስ ፕሮጀክት መፍጠር፣ ነባር ፕሮጀክትን ማስተካከል (Edit) እና ማጥፋት።
   - **Skills**: አዳዲስ ክህሎቶችን መጨመር፣ የብቃት ደረጃቸውን ማስተካከል እና ማጥፋት።
   - **Journey & Experience**: የስራ ልምድ እና የትምህርት ታሪክን ማስተዳደር።
   - **Profile Settings**: በገጹ ላይ የሚታዩ ስሞችን፣ የጀርባ ጽሁፎችን እና ማህበራዊ አውታሮችን በቀጥታ በዳታቤዝ ማሻሻል።
   - **Security**: የይለፍ ቃል መቀየር።

---

## 🛠️ የቴክኖሎጂ ቁልሎች (Tech Stack)

- **Backend**: Laravel 11.x, PHP 8.x, Laravel Sanctum (Token Auth)
- **Frontend**: Vue.js 3 (Composition API), Vite, Tailwind CSS, Axios
- **Database**: MySQL 8.0 / MariaDB (Database Name: `portfolio_db`)
- **Testing**: PHPUnit / Pest (Automated Feature & Validation Tests)

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
