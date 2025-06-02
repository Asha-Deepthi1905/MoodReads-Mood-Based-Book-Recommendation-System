MoodReads — A Mood-Based Book Recommendation Engine

MoodReads is a personalized web-based book recommendation system that matches your mood or vibe to books that carry a similar emotional tone. 
Instead of choosing from fixed genres, users simply describe how they feel — and MoodReads does the rest.


FEATURES:-

1. Mood-to-Vibe Mapping
Type “I feel nostalgic” or “Need something magical” — we map it to tags like nostalgic, magical, uplifting, etc.

2. Smart Book Recommendations
Dynamically fetches books from a MySQL database based on matched vibes.

3.  Favorites System
Add books to your favorites by clicking the ❤️ icon. View them anytime from your dashboard.

4. Mood History Logging
All your mood inputs are saved with timestamps. Reflect on how you’ve felt and what helped.

5. Secure Authentication
Login & Signup system using PHP sessions and password hashing.

6. Book Detail Popup
Click on any book to view full summary, year, and associated vibes in a modal.

7. Clean UI 
Styled with CSS, playful fonts and cozy colors


TECH USED:-

 Frontend :- HTML, CSS, JavaScript     
 Backend  :- PHP (with PDO)            
 Database :-  MySQL                     
 Hosting  :-  XAMPP / Localhost         


HOW IT WORKS:-

1. User inputs a free-text mood (e.g., “I feel anxious and restless.”)
2. JavaScript sends this mood via fetch() to recommend.php
3. PHP matches mood → vibe using a keyword map (e.g. "anxious" → anxious)
4. SQL joins tables (books + vibe_tags) to fetch matching books
5. Books are displayed as cards with cover, title, author & ❤️ icon
6. User clicks ❤️ → triggers save_favorite.php → adds book to favorites table


DATABASE SCHHEMA(TABLES):-

1. users
2. books
3. vibe_tags
4. book_vibe_tags (many-to-many)
5. mood_logs
6. favorites


FUTURE ENHANCEMENTS:- 

1.Genre selection + mood combo search
2.Mood prompt buttons
3.AI sentiment analysis on free-text mood
