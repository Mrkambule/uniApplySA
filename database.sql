-- Database schema for UniApply SA
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  is_admin TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS institutions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  province VARCHAR(60) NOT NULL,
  fields TEXT NOT NULL, -- comma-separated
  application_url VARCHAR(500) NOT NULL,
  description TEXT,
  timeline TEXT,
  requirements TEXT
);

CREATE TABLE IF NOT EXISTS bursaries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  program VARCHAR(200) NOT NULL,
  merit_type VARCHAR(40) NOT NULL, -- Need-based, Merit-based, Both
  province VARCHAR(60) NOT NULL DEFAULT 'National',
  deadline DATE,
  url VARCHAR(500) NOT NULL,
  description TEXT
);

CREATE TABLE IF NOT EXISTS faq (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question VARCHAR(255) NOT NULL,
  answer TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS checklist (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  text VARCHAR(255) NOT NULL,
  is_done TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Seed admin
INSERT INTO users (name,email,password_hash,is_admin) VALUES
('Admin','admin@example.com', '$2y$10$kD1s8YQmZQhnf6FQMV8WmOMt37l7k1V/cK8TmqQ5XG8w3wC8JB6nS', 1);
-- Password = Admin@123

-- Sample institutions
INSERT INTO institutions(name,province,fields,application_url,description,timeline,requirements) VALUES
('University of Cape Town (UCT)','Western Cape','Engineering,Commerce,Law,Health Sciences,Humanities','https://www.uct.ac.za/apply','Top-ranked SA university.','Applications open: April; Close: July 31','ID copy; latest results; application fee proof; NSC results'),
('University of the Witwatersrand (Wits)','Gauteng','Engineering,Health Sciences,Science,Commerce,Humanities','https://www.wits.ac.za/applications/','Research-intensive university in Johannesburg.','Open: March; Close: Sept 30','ID; Grade 11/12 results; NBT (some programmes)'),
('Durban University of Technology (DUT)','KwaZulu-Natal','Applied Sciences,Engineering,Health Sciences,Management','https://www.dut.ac.za/apply/','University of technology with industry ties.','Open: May; Close: Oct 31','ID; results; relevant certificates');

-- Sample bursaries
INSERT INTO bursaries(name,program,merit_type,province,deadline,url,description) VALUES
('NSFAS','Any','Need-based','National','2025-01-31','https://www.nsfas.org.za/','National Student Financial Aid Scheme for eligible learners.'),
('Allan Gray Orbis Foundation Fellowship','Commerce','Merit-based','National','2025-05-01','https://www.allangrayorbis.org/','Entrepreneurship-focused fellowship.'),
('Funza Lushaka','Education','Both','National','2025-02-28','https://www.funzalushaka.doe.gov.za/','Bursary for teaching students.');

-- Sample FAQ
INSERT INTO faq(question, answer) VALUES
('What documents are needed for most applications?','ID copy, latest academic results, proof of address, motivational letter, and certified copies are commonly required.'),
('When do UCT applications open?','UCT typically opens around April and closes by end of July; always verify on the official site.'),
('How do I apply for NSFAS?','Apply on the NSFAS website, create an account, upload required documents, and track your status online.');
