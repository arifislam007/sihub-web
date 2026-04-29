-- Sombhabona Innovation Hub Database Setup
-- PostgreSQL Database Schema

-- Create database (if needed, execute separately)
-- CREATE DATABASE sombhabona_hub;

-- Drop existing tables if they exist (for fresh setup)
DROP TABLE IF EXISTS leads CASCADE;
DROP TABLE IF EXISTS courses CASCADE;

-- Create courses table
CREATE TABLE courses (
    id SERIAL PRIMARY KEY,
    name_en VARCHAR(255) NOT NULL,
    name_bn VARCHAR(255) NOT NULL,
    description_en TEXT,
    description_bn TEXT,
    category VARCHAR(50),
    fee_amount DECIMAL(10, 2),
    discount_percentage INT DEFAULT 0,
    duration_months INT,
    schedule_en VARCHAR(255),
    schedule_bn VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create leads table for contact form submissions
CREATE TABLE leads (
    id SERIAL PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    course_id INT REFERENCES courses(id),
    course_name VARCHAR(255),
    message TEXT,
    status VARCHAR(50) DEFAULT 'new', -- new, contacted, enrolled, rejected
    source VARCHAR(50) DEFAULT 'contact_form',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address INET
);

-- Insert sample courses
INSERT INTO courses (name_en, name_bn, description_en, description_bn, category, fee_amount, discount_percentage, duration_months, schedule_en, schedule_bn)
VALUES 
    ('Spoken English - Level 1', 'স্পোকেন ইংরেজি - লেভেল ১', 'Beginner level English course', 'শিক্ষানবিস স্তরের ইংরেজি কোর্স', 'english', 1500, 0, 3, 'Fri & Sat (2 Hrs/Class)', 'শুক্রবার ও শনিবার (২ ঘন্টা/ক্লাস)'),
    ('Spoken English - Level 2', 'স্পোকেন ইংরেজি - লেভেল ২', 'Intermediate level English course', 'মধ্যবর্তী স্তরের ইংরেজি কোর্স', 'english', 1500, 0, 3, 'Fri & Sat (2 Hrs/Class)', 'শুক্রবার ও শনিবার (২ ঘন্টা/ক্লাস)'),
    ('Spoken English - Level 3', 'স্পোকেন ইংরেজি - লেভেল ৩', 'Advanced level English course', 'উন্নত স্তরের ইংরেজি কোর্স', 'english', 1500, 0, 3, 'Fri & Sat (2 Hrs/Class)', 'শুক্রবার ও শনিবার (২ ঘন্টা/ক্লাস)'),
    ('Basic Computer', 'মৌলিক কম্পিউটার', 'Fundamentals, MS Word, Excel, PowerPoint', 'মৌলিক বিষয়, এমএস ওয়ার্ড, এক্সেল, পাওয়ারপয়েন্ট', 'it', 3000, 50, 2, 'Weekdays 6-8 PM', 'সপ্তাহের দিন ৬-৮ পিএম'),
    ('Digital Marketing & Graphics', 'ডিজিটাল মার্কেটিং ও গ্রাফিক্স', 'FB Marketing, Canva, Photoshop, SEO', 'ফেসবুক মার্কেটিং, ক্যানভা, ফটোশপ, এসইও', 'it', 7500, 50, 3, 'Weekdays 6-8 PM', 'সপ্তাহের দিন ৬-৮ পিএম'),
    ('Linux & DevOps', 'লিনাক্স ও ডেভপস', 'Linux Operation, Docker, CI/CD workflows', 'লিনাক্স অপারেশন, ডকার, সিআই/সিডি', 'it', 0, 0, 3, 'Flexible', 'নমনীয়'),
    ('NSDA - Digital Marketing Level 3', 'এনএসডিএ - ডিজিটাল মার্কেটিং লেভেল ৩', 'National certification program', 'জাতীয় সার্টিফিকেশন প্রোগ্রাম', 'advanced', 0, 0, 3, 'Flexible', 'নমনীয়');

-- Create index for better query performance
CREATE INDEX idx_leads_email ON leads(email);
CREATE INDEX idx_leads_phone ON leads(phone);
CREATE INDEX idx_leads_created_at ON leads(created_at);
CREATE INDEX idx_leads_status ON leads(status);
CREATE INDEX idx_courses_category ON courses(category);

-- Create admin table for admin access
CREATE TABLE IF NOT EXISTS admin_users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP
);

-- Grant permissions
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO postgres;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO postgres;
