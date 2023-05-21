
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS client;
DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS agent;
DROP TABLE IF EXISTS ticket;
DROP TABLE IF EXISTS reply;
DROP TABLE IF EXISTS department;
DROP TABLE IF EXISTS ticket_status;
DROP TABLE IF EXISTS ticket_department;
DROP TABLE IF EXISTS ticket_ticket_status;
DROP TABLE IF EXISTS agent_department;
DROP TABLE IF EXISTS admin_department;
DROP TABLE IF EXISTS faq;




CREATE TABLE users (
    id INTEGER PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,   
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE client (
    id INTEGER PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES users(id)
);

CREATE TABLE admin (
    id INTEGER PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES users(id)
);

CREATE TABLE agent (
    id INTEGER PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES users(id)
);

CREATE TABLE ticket (
    id INTEGER PRIMARY KEY,
    user_id INTEGER NOT NULL,
    subject VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    --hashtags VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    post_date DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE reply (
    id INTEGER PRIMARY KEY,
    ticket_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    comment TEXT NOT NULL,
    reply_date DATETIME NOT NULL,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE department (
    id INTEGER PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE ticket_status (
    id INTEGER PRIMARY KEY,
    status TEXT CHECK(status IN ('open', 'closed', 'assigned', 'solved')) NOT NULL,
    change_status_date DATETIME NOT NULL
);

CREATE TABLE ticket_department (
    id INTEGER PRIMARY KEY,
    ticket_id INTEGER NOT NULL,
    department_id INTEGER NOT NULL,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id),
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

CREATE TABLE ticket_ticket_status (
    id INTEGER PRIMARY KEY,
    ticket_id INT NOT NULL,
    ticket_status_id INT NOT NULL,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id),
    FOREIGN KEY (ticket_status_id) REFERENCES ticket_status(id)
);

CREATE TABLE agent_department (
    id INTEGER PRIMARY KEY,
    agent_id INTEGER NOT NULL,
    department_id INTEGER NOT NULL,
    FOREIGN KEY (agent_id) REFERENCES agents(id),
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

CREATE TABLE admin_department (
    id INTEGER PRIMARY KEY,
    admin_id INTEGER NOT NULL,
    department_id INTEGER NOT NULL,
    FOREIGN KEY (admin_id) REFERENCES admins(id),
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

CREATE TABLE faq (
    id INTEGER PRIMARY KEY,
    question VARCHAR(255) NOT NULL,
    answer VARCHAR(255) NOT NULL
);


insert into users (id, username, first_name, last_name, email, password) values (1, 'pcaddan0', 'Pru', 'Caddan', 'pcaddan0@twitpic.com', '$2y$10$HjLRBTlT5iVAHrqVNV.lveAL39z5443I7M0BOiwBOtf86Hre1j6v6'); --Ilovelasagna
insert into users (id, username, first_name, last_name, email, password) values (2, 'bchieco1', 'Bat', 'Chieco', 'bchieco1@deliciousdays.com', '$2y$10$5w1bzmEPa7sscMelxuDF8.3pkjwKMnzukHrHN6lTBH19CldErtIFK'); --Donttrytohackme
insert into users (id, username, first_name, last_name, email, password) values (3, 'elesieur2', 'Emilee', 'Le Sieur', 'elesieur2@vistaprint.com', '$2y$10$yo4YStNd7yUFltBTeH2lHORKxPhC9xyjmBP/VZK.daWeqSqRuZpke'); --Iamnotarobot
insert into users (id, username, first_name, last_name, email, password) values (4, 'bhandes3', 'Bastian', 'Handes', 'bhandes3@arizona.edu', '$2y$10$INhcKCTKtkR3GgkYW/zZlOS3Xu54IhH3nBzbeiK.bPnWuuf5c4xQC'); --iamaRobot
insert into users (id, username, first_name, last_name, email, password) values (5, 'afossord4', 'Alaric', 'Fossord', 'afossord4@utexas.edu', '$2y$10$.fuPp/XM0gHHeyG0kAT0V.JzAmECPFuIAzjrGzrQlvhJGPvLSqPzO'); --iamanAgent
insert into users (id, username, first_name, last_name, email, password) values (6, 'cguidi5', 'Conney', 'Guidi', 'cguidi5@ibm.com', '$2y$10$0IcMLJ86gKXKaDyTjAfZC.HshkWTE9gj5Mis90EQ2yKMkfR1tSmbS'); --AgentoftheMonth
insert into users (id, username, first_name, last_name, email, password) values (7, 'nmolian6', 'Nolan', 'Molian', 'nmolian6@amazon.co.jp', '$2y$10$EThvreVqQ/N/XtYd1Y1AZOxI.52K5MaVVlGERK6Nxg1dGKhoRYM1i'); --purplechocolate123
insert into users (id, username, first_name, last_name, email, password) values (8, 'rrawstron7', 'Ruby', 'Rawstron', 'rrawstron7@yandex.ru', '2y$10$krzStixvJmQDonIIXlqvb./imxzBc4c5mvCeZA32ZRnLtcLR9p8tW'); --IamanAdmin
insert into users (id, username, first_name, last_name, email, password) values (9, 'fnewick8', 'Felice', 'Newick', 'fnewick8@google.com.hk', '$2y$10$5yV12x6RHKGgVOUtQMP25.mlm0vjys5Usyapr33U/hSzBsVNttod.'); --Iownthissite777
insert into users (id, username, first_name, last_name, email, password) values (10, 'mwaind9', 'Maia', 'Waind', 'mwaind9@netlog.com', '$2y$10$TqKa5HPdvII/Ut8ayoZBo.dBjuRViUd/J1lsPwmj8b09afOXV3vQK'); --Iamnotanadmin


insert into client (id) values (1);
insert into client (id) values (2);
insert into client (id) values (3);
insert into client (id) values (4);

insert into admin (id) values (5);
insert into admin (id) values (6);
insert into admin (id) values (7);

insert into agent (id) values (8);
insert into agent (id) values (9);
insert into agent (id) values (10);

insert into ticket (id, user_id, subject, content, department, post_date) values (1, 1, ' Issue with Account Login',' I am unable to log into my account despite entering the correct credentials. Requesting assistance in resolving the login issue promptly.', 'Business Development', '2022-11-14 16:25:45');
insert into ticket (id, user_id, subject, content, department, post_date) values (2, 2, 'Payment Discrepancy', 'There is a discrepancy in the charged amount for my recent payment. Kindly investigate and rectify the issue for the correct refund or credit.', 'Sales', '2022-10-18 16:42:00');
insert into ticket (id, user_id, subject, content, department, post_date) values (3, 3, 'Product Delivery Delay', 'My ordered product has not been delivered within the estimated timeframe. Seeking an update on the status and a resolution for the delayed delivery.', 'Engineering', '2022-07-20 07:36:43');
insert into ticket (id, user_id, subject, content, department, post_date) values (4, 4, 'Technical Issue with Website Functionality', 'Encountering a technical issue on your website with a specific functionality. Requesting support to resolve the issue affecting my workflow.', 'Research and Development', '2022-04-26 09:20:58');
insert into ticket (id, user_id, subject, content, department, post_date) values (5, 5, 'Request for Refund', 'Requesting a refund for a recent purchase due to dissatisfaction with the product/service received. Providing reasons for the refund request.', 'Support', '2022-11-06 00:42:29');
insert into ticket (id, user_id, subject, content, department, post_date) values (6, 6, 'Account Deactivation Request', 'I would like to request the deactivation of my account on your platform. Please assist me in permanently closing my account and deleting all associated data.', 'Human Resources', '2022-09-19 18:11:23');
insert into ticket (id, user_id, subject, content, department, post_date) values (7, 7, 'Missing Order from Shipment', 'One of the items in my recent order is missing from the shipment received. Kindly investigate and arrange for the missing item to be sent promptly or provide a suitable resolution.', 'Product Management', '2022-05-29 07:28:49');
insert into ticket (id, user_id, subject, content, department, post_date) values (8, 8, 'Incorrect Product Received', 'I received a different product than what I had ordered. Requesting assistance in arranging for the correct product to be delivered or initiating a return and refund process.', 'Support', '2023-02-25 21:42:45');
insert into ticket (id, user_id, subject, content, department, post_date) values (9, 9, 'Unresponsive Customer Support', 'I have been trying to contact your customer support regarding an issue, but I have not received any response or assistance. Kindly address this matter promptly and ensure better communication moving forward.', 'Engineering', '2022-09-01 13:05:40');
insert into ticket (id, user_id, subject, content, department, post_date) values (10, 10, 'Subscription Cancellation Request', 'I would like to cancel my subscription to your service. Please assist me in canceling the subscription and ensure that I am not billed for any further periods.', 'Services', '2022-09-30 16:24:59');


insert into reply (id, ticket_id, user_id, comment, reply_date) values (1, 1, 5, 'Thank you for reporting the login issue. We apologize for the inconvenience. Our technical team is investigating the matter and will work to resolve it as soon as possible. We appreciate your patience.', '2022-09-10 13:48:57');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (2, 2, 6, 'Thank you for reporting the login issue. We apologize for the inconvenience. Our technical team is investigating the matter and will work to resolve it as soon as possible. We appreciate your patience.', '2023-02-28 09:50:12');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (3, 3, 7, 'Thank you for reporting the login issue. We apologize for the inconvenience. Our technical team is investigating the matter and will work to resolve it as soon as possible. We appreciate your patience.', '2022-10-17 14:19:42');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (4, 4, 8, 'Thank you for reporting the login issue. We apologize for the inconvenience. Our technical team is investigating the matter and will work to resolve it as soon as possible. We appreciate your patience.', '2022-09-09 12:54:32');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (5, 5, 9, 'Thank you for reporting the login issue. We apologize for the inconvenience. Our technical team is investigating the matter and will work to resolve it as soon as possible. We appreciate your patience.', '2022-06-01 07:13:22');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (6, 6, 10, 'Thank you for reporting the login issue. We apologize for the inconvenience. Our technical team is investigating the matter and will work to resolve it as soon as possible. We appreciate your patience.', '2022-07-08 16:06:06');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (7, 7, 6, 'Thank you for reporting the login issue. We apologize for the inconvenience. Our technical team is investigating the matter and will work to resolve it as soon as possible. We appreciate your patience.', '2022-11-23 18:33:35');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (8, 8, 5, 'Thank you for reporting the login issue. We apologize for the inconvenience. Our technical team is investigating the matter and will work to resolve it as soon as possible. We appreciate your patience.', '2022-09-05 21:46:10');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (9, 9, 7, 'Thank you for reporting the login issue. We apologize for the inconvenience. Our technical team is investigating the matter and will work to resolve it as soon as possible. We appreciate your patience.', '2022-09-27 04:35:57');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (10, 10, 10, 'Thank you for reporting the login issue. We apologize for the inconvenience. Our technical team is investigating the matter and will work to resolve it as soon as possible. We appreciate your patience.', '2022-08-22 19:55:37');


insert into department (id, name) values (1, 'Business Development');
insert into department (id, name) values (2, 'Sales');
insert into department (id, name) values (3, 'Engineering');
insert into department (id, name) values (4, 'Research and Development');
insert into department (id, name) values (5, 'Support');
insert into department (id, name) values (6, 'Human Resources');
insert into department (id, name) values (7, 'Product Management');
insert into department (id, name) values (8, 'Support');
insert into department (id, name) values (9, 'Engineering');
insert into department (id, name) values (10, 'Services');


insert into ticket_status (id, status, change_status_date) values (1, 'open', '2023-01-31 10:09:10');
insert into ticket_status (id, status, change_status_date) values (2, 'assigned', '2022-06-23 18:43:37');
insert into ticket_status (id, status, change_status_date) values (3, 'solved', '2022-12-01 02:10:52');
insert into ticket_status (id, status, change_status_date) values (4, 'closed', '2022-10-09 08:23:24');
insert into ticket_status (id, status, change_status_date) values (5, 'assigned', '2022-10-11 14:26:06');
insert into ticket_status (id, status, change_status_date) values (6, 'assigned', '2023-01-24 02:00:12');
insert into ticket_status (id, status, change_status_date) values (7, 'solved', '2022-11-05 20:23:10');
insert into ticket_status (id, status, change_status_date) values (8, 'open', '2022-11-25 10:44:59');
insert into ticket_status (id, status, change_status_date) values (9, 'open', '2022-05-01 22:23:18');
insert into ticket_status (id, status, change_status_date) values (10, 'open', '2022-12-13 09:53:41');


insert into ticket_department (id, ticket_id, department_id) values (1, 1, 1);
insert into ticket_department (id, ticket_id, department_id) values (2, 2, 2);
insert into ticket_department (id, ticket_id, department_id) values (3, 3, 3);
insert into ticket_department (id, ticket_id, department_id) values (4, 4, 4);
insert into ticket_department (id, ticket_id, department_id) values (5, 5, 5);
insert into ticket_department (id, ticket_id, department_id) values (6, 6, 6);
insert into ticket_department (id, ticket_id, department_id) values (7, 7, 7);
insert into ticket_department (id, ticket_id, department_id) values (8, 8, 8);
insert into ticket_department (id, ticket_id, department_id) values (9, 9, 9);
insert into ticket_department (id, ticket_id, department_id) values (10, 10, 10);


insert into ticket_ticket_status (id, ticket_id, ticket_status_id) values (1, 1, 1);
insert into ticket_ticket_status (id, ticket_id, ticket_status_id) values (2, 2, 2);
insert into ticket_ticket_status (id, ticket_id, ticket_status_id) values (3, 3, 3);
insert into ticket_ticket_status (id, ticket_id, ticket_status_id) values (4, 4, 4);
insert into ticket_ticket_status (id, ticket_id, ticket_status_id) values (5, 5, 5);
insert into ticket_ticket_status (id, ticket_id, ticket_status_id) values (6, 6, 6);
insert into ticket_ticket_status (id, ticket_id, ticket_status_id) values (7, 7, 7);
insert into ticket_ticket_status (id, ticket_id, ticket_status_id) values (8, 8, 8);
insert into ticket_ticket_status (id, ticket_id, ticket_status_id) values (9, 9, 9);
insert into ticket_ticket_status (id, ticket_id, ticket_status_id) values (10, 10, 10);


insert into agent_department (id, agent_id, department_id) values (1, 8, 1);
insert into agent_department (id, agent_id, department_id) values (2, 9, 2);
insert into agent_department (id, agent_id, department_id) values (3, 10, 3);


insert into admin_department (id, admin_id, department_id) values (1, 5, 1);
insert into admin_department (id, admin_id, department_id) values (2, 6, 2);
insert into admin_department (id, admin_id, department_id) values (3, 7, 3);

insert into faq (id, question, answer) values (1, 'How do I set up a ticket?', 'Setting up a ticket is very simple. Just head to the home page and click the ''Create Ticket'' button on your right and you''ll be redirected to the appropriated page. Make sure you''re logged in first.');
insert into faq (id, question, answer) values (2, 'Where can I view my tickets?', 'You can view all of the tickets you''ve created on your profile, accessible through the respective button on the navigation bar.');


