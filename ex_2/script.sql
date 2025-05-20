-- Drop tables if they exist to avoid conflicts during repeated runs
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS authors;

-- Table: authors
CREATE TABLE authors (
    id SERIAL PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name  VARCHAR(100) NOT NULL
);

-- Table: books
CREATE TABLE books (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    publication_year INT CHECK (publication_year > 0) NOT NULL,
    isbn VARCHAR(20) UNIQUE NOT NULL,
    author_id INT NOT NULL REFERENCES authors(id) ON DELETE CASCADE
);

-- Table: reviews
CREATE TABLE reviews (
    id SERIAL PRIMARY KEY,
    book_id INT NOT NULL REFERENCES books(id) ON DELETE CASCADE,
    rating INT NOT NULL CHECK (rating BETWEEN 1 AND 10),
    content TEXT
);

-- Index: books.author_id (improves JOIN performance on author_id)
CREATE INDEX idx_books_author_id ON books(author_id);

-- Index: reviews.book_id (improves JOIN performance on book_id)
CREATE INDEX idx_reviews_book_id ON reviews(book_id);

-- Query: List all authors with the number of books they have written
SELECT
    author.first_name AS author_first_name,
    author.last_name AS author_last_name,
    COUNT(book.id) AS total_books_written
FROM
    authors AS author
LEFT JOIN
    books AS book ON author.id = book.author_id
GROUP BY
    author.id, author.first_name, author.last_name;


-- View: Top 5 authors by average book rating (including authors with no reviews)
CREATE OR REPLACE VIEW top_5_authors_by_avg_rating AS
SELECT
    author.id AS author_id,
    author.first_name AS author_first_name,
    author.last_name AS author_last_name,
    COALESCE(ROUND(AVG(review.rating)::numeric, 2), 0) AS average_book_rating,
    COUNT(DISTINCT book.id) AS total_books_written,
    COALESCE(COUNT(review.id), 0) AS total_reviews
FROM
    authors AS author
JOIN
    books AS book ON author.id = book.author_id
LEFT JOIN
    reviews AS review ON book.id = review.book_id
GROUP BY
    author.id, author.first_name, author.last_name
ORDER BY
    average_book_rating DESC,
    total_reviews DESC,
    total_books_written DESC
LIMIT 5;
