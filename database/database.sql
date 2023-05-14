
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
    hashtags VARCHAR(255) NOT NULL,
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
    id IINTEGER PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE ticket_status (
    id INTEGER PRIMARY KEY,
    status TEXT CHECK(status IN ('open', 'closed', 'assigned', 'resolved')) NOT NULL,
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


insert into users (id, username, first_name, last_name, email, password) values (1, 'pcaddan0', 'Pru', 'Caddan', 'pcaddan0@twitpic.com', 'EMlEoH5wmjl9');
insert into users (id, username, first_name, last_name, email, password) values (2, 'bchieco1', 'Bat', 'Chieco', 'bchieco1@deliciousdays.com', 'nG8jEI');
insert into users (id, username, first_name, last_name, email, password) values (3, 'elesieur2', 'Emilee', 'Le Sieur', 'elesieur2@vistaprint.com', 'r7gOkzg');
insert into users (id, username, first_name, last_name, email, password) values (4, 'bhandes3', 'Bastian', 'Handes', 'bhandes3@arizona.edu', 'r8WPO9Fl');
insert into users (id, username, first_name, last_name, email, password) values (5, 'afossord4', 'Alaric', 'Fossord', 'afossord4@utexas.edu', 'RJsqD7');
insert into users (id, username, first_name, last_name, email, password) values (6, 'cguidi5', 'Conney', 'Guidi', 'cguidi5@ibm.com', 'ULYxwbj');
insert into users (id, username, first_name, last_name, email, password) values (7, 'nmolian6', 'Nolan', 'Molian', 'nmolian6@amazon.co.jp', 'OSXg7uPD3a');
insert into users (id, username, first_name, last_name, email, password) values (8, 'rrawstron7', 'Ruby', 'Rawstron', 'rrawstron7@yandex.ru', 'MPh3FqxT');
insert into users (id, username, first_name, last_name, email, password) values (9, 'fnewick8', 'Felice', 'Newick', 'fnewick8@google.com.hk', 'E51HZpZXD5');
insert into users (id, username, first_name, last_name, email, password) values (10, 'mwaind9', 'Maia', 'Waind', 'mwaind9@netlog.com', 'e9gEFV6nbNWy');


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

insert into ticket (id, user_id, subject, content, hashtags, post_date) values (1, 1, 'luctus et ultrices posuere cubilia curae mauris viverra diam vitae quam suspendisse potenti nullam porttitor lacus at turpis donec', 'eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes', 'est phasellus sit amet erat nulla tempus vivamus in felis eu sapien cursus vestibulum proin eu mi', '2022-11-14 16:25:45');
insert into ticket (id, user_id, subject, content, hashtags, post_date) values (2, 2, 'maecenas pulvinar lobortis est phasellus sit amet erat nulla tempus vivamus in', 'id luctus nec molestie sed justo pellentesque viverra pede ac diam', 'consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent', '2022-10-18 16:42:00');
insert into ticket (id, user_id, subject, content, hashtags, post_date) values (3, 3, 'vulputate justo in blandit ultrices enim lorem ipsum dolor sit', 'viverra eget congue eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien a', 'morbi porttitor lorem id ligula suspendisse ornare consequat lectus in est risus auctor sed tristique in tempus sit amet', '2022-07-20 07:36:43');
insert into ticket (id, user_id, subject, content, hashtags, post_date) values (4, 4, 'laoreet ut rhoncus aliquet pulvinar sed nisl nunc rhoncus dui vel sem sed sagittis nam', 'sapien in sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit at vulputate vitae nisl', 'rhoncus dui vel sem sed sagittis nam congue risus semper porta volutpat', '2022-04-26 09:20:58');
insert into ticket (id, user_id, subject, content, hashtags, post_date) values (5, 5, 'ut rhoncus aliquet pulvinar sed nisl nunc rhoncus dui vel sem sed sagittis nam congue', 'vel nulla eget eros elementum pellentesque quisque porta volutpat erat quisque erat eros viverra eget', 'ipsum aliquam non mauris morbi non lectus aliquam sit amet diam in', '2022-11-06 00:42:29');
insert into ticket (id, user_id, subject, content, hashtags, post_date) values (6, 6, 'vehicula condimentum curabitur in libero ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt', 'quis turpis sed ante vivamus tortor duis mattis egestas metus aenean fermentum donec', 'interdum in ante vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere', '2022-09-19 18:11:23');
insert into ticket (id, user_id, subject, content, hashtags, post_date) values (7, 7, 'dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum at', 'a pede posuere nonummy integer non velit donec diam neque vestibulum', 'phasellus id sapien in sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit at vulputate vitae nisl aenean lectus', '2022-05-29 07:28:49');
insert into ticket (id, user_id, subject, content, hashtags, post_date) values (8, 8, 'potenti nullam porttitor lacus at turpis donec posuere metus vitae ipsum aliquam non mauris morbi', 'elit ac nulla sed vel enim sit amet nunc viverra dapibus nulla suscipit ligula in lacus', 'sit amet justo morbi ut odio cras mi pede malesuada in imperdiet et commodo vulputate justo in blandit ultrices enim', '2023-02-25 21:42:45');
insert into ticket (id, user_id, subject, content, hashtags, post_date) values (9, 9, 'orci vehicula condimentum curabitur in libero ut massa volutpat convallis morbi odio odio elementum eu interdum', 'vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna', 'tincidunt in leo maecenas pulvinar lobortis est phasellus sit amet erat nulla tempus', '2022-09-01 13:05:40');
insert into ticket (id, user_id, subject, content, hashtags, post_date) values (10, 10, 'volutpat in congue etiam justo etiam pretium iaculis justo in hac', 'vitae quam suspendisse potenti nullam porttitor lacus at turpis donec posuere metus vitae ipsum aliquam non mauris morbi non', 'accumsan odio curabitur convallis duis consequat dui nec nisi volutpat', '2022-09-30 16:24:59');


insert into reply (id, ticket_id, user_id, comment, reply_date) values (1, 1, 1, 'ultrices libero non mattis pulvinar nulla pede ullamcorper augue a suscipit', '2022-09-10 13:48:57');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (2, 2, 2, 'in sagittis dui vel nisl duis ac nibh fusce lacus', '2023-02-28 09:50:12');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (3, 3, 3, 'lacus morbi sem mauris laoreet ut rhoncus aliquet pulvinar sed nisl nunc rhoncus', '2022-10-17 14:19:42');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (4, 4, 4, 'nibh fusce lacus purus aliquet at feugiat non pretium quis lectus suspendisse potenti in', '2022-09-09 12:54:32');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (5, 5, 5, 'pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat id mauris vulputate', '2022-06-01 07:13:22');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (6, 6, 6, 'venenatis tristique fusce congue diam id ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed augue aliquam erat', '2022-07-08 16:06:06');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (7, 7, 7, 'pede venenatis non sodales sed tincidunt eu felis fusce posuere felis sed lacus morbi sem', '2022-11-23 18:33:35');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (8, 8, 8, 'nec nisi vulputate nonummy maecenas tincidunt lacus at velit vivamus vel nulla eget eros', '2022-09-05 21:46:10');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (9, 9, 9, 'accumsan felis ut at dolor quis odio consequat varius integer ac', '2022-09-27 04:35:57');
insert into reply (id, ticket_id, user_id, comment, reply_date) values (10, 10, 10, 'in magna bibendum imperdiet nullam orci pede venenatis non sodales sed tincidunt eu felis', '2022-08-22 19:55:37');


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
insert into ticket_status (id, status, change_status_date) values (2, 'open', '2022-06-23 18:43:37');
insert into ticket_status (id, status, change_status_date) values (3, 'open', '2022-12-01 02:10:52');
insert into ticket_status (id, status, change_status_date) values (4, 'open', '2022-10-09 08:23:24');
insert into ticket_status (id, status, change_status_date) values (5, 'open', '2022-10-11 14:26:06');
insert into ticket_status (id, status, change_status_date) values (6, 'open', '2023-01-24 02:00:12');
insert into ticket_status (id, status, change_status_date) values (7, 'open', '2022-11-05 20:23:10');
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

insert into faq (id, question, answer) values (1, 'How do I book a flight?', 'You can book a flight by visiting our website, using our mobile app, or contacting our customer service center. Provide your travel details such as destination, dates, and passenger information, and follow the prompts to complete the booking process.');
insert into faq (id, question, answer) values (2, 'What information do I need to provide when booking a flight?', 'You will typically need to provide your full name, contact information, travel dates, preferred departure and arrival airports, and the number of passengers traveling with you.');
insert into faq (id, question, answer) values (3, 'Can I make changes to my booking?', 'Yes, depending on the fare type and airline policy, you may be able to make changes to your booking. Please review our terms and conditions or contact our customer service for assistance.');
insert into faq (id, question, answer) values (4, 'How much baggage am I allowed to bring?', 'Baggage allowances vary depending on the airline and ticket type. We recommend checking our website or contacting our customer service to find specific details about baggage allowances for your flight.');
insert into faq (id, question, answer) values (5, 'How can I check-in for my flight?', 'You can check-in online through our website or mobile app, or at the airport at designated check-in counters. Online check-in usually opens 24 hours prior to the scheduled departure time.');
insert into faq (id, question, answer) values (6, 'What travel documents do I need to carry?', 'You will generally need to carry a valid passport for international travel. For domestic flights, a government-issued photo ID may be sufficient. It''s important to check the entry requirements of your destination country and any transit countries before you travel.');
insert into faq (id, question, answer) values (7, 'What happens if my flight is delayed or canceled?', 'In the event of a delay or cancellation, we will make every effort to inform you in advance. You may be eligible for compensation or alternative arrangements, depending on the circumstances. Please refer to our terms and conditions or contact our customer service for assistance.');
insert into faq (id, question, answer) values (8, 'Can I request special assistance or services?', 'Yes, we provide special assistance for passengers with disabilities or medical conditions. Please inform us at the time of booking or contact our customer service.');
insert into faq (id, question, answer) values (9, 'What are the accepted payment methods for booking?', 'We accept various payment methods, including credit cards, debit cards, and online payment platforms. Please check our website or contact our customer service for the specific payment options available.');
insert into faq (id, question, answer) values (10, 'What is the baggage allowance for infants?', 'Infants traveling on a ticket without a seat usually have a limited baggage allowance. Please check our website or contact our customer service for details specific to your booking.');  


