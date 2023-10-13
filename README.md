# SeatAssist_WebSite

Our product in the project is called Seat Assist. We have chosen to create a platform for managing seating arrangements in open-space offices of office companies. The application provides a flexible solution and optimal utilization of office space. The application will create a platform that allows users (office employees) to access the seating reservation system according to relevant workdays, from anywhere and at any time, without the need for customer service. Users will be able to view the office map to reserve their preferred seats, see occupied seats, view their seating history, and more.

![image](https://github.com/MatanShemesh10/SeatAssist_WebSite/assets/122441156/d8b91d56-25ae-4bc3-b173-a0933a43e1f4)

**Background:**
In today's market, there are companies that employ many employees, which require large office spaces, team allocations, and maintenance expenses. From a social perspective, traditional offices create a rift among employees, affecting team cohesion, as employees spend most of their day in closed rooms and are not exposed to what is happening around them. In recent years, more and more companies have adopted the open-space office solution - a workspace with personal desks instead of individual offices.

Features and Extensions on the Website:
• Admin Profile – Through the login page, we created an admin profile that can access the site and manage all existing user reservations. We added different background music than the regular homepage, and, in addition, each reservation grid will display the username that made it. Similarly to the "My Reservations" page, the admin can edit or delete reservations.
• In all website pages, we used PHP SESSION functions, which allows us to pass the connected user's details every time without sending requests to the database for information.
• Night Mode – In all website pages, there is a toggle that will allow switching to night mode – changing the colors to black and white. At any time, you can return the site to its previous mode or go to another page.
• Edit Reservation – Through "My Reservations," the user can go to a new view on the same page to edit an existing reservation and return to the "My Reservations" page.
• Office Map – In the reservation pages, the user can view the office map and use it to choose a seat.
• In all website pages, there will be a user cube on the left with quick buttons to edit the profile, add a reservation, send a report form, and log out.
• Users cannot reserve more than one seat on the same date.
• Users can only reserve a seat from the current date onward.
• In a new reservation, only available seats will be displayed.
• Users cannot submit empty forms (Profile, Report, Edit Reservation, Registration, Login).
• On the homepage, the user's next reservation will be displayed.
• Information updates in real-time against the database and will render the page, so any change in information is displayed directly.
• We added an animation on the site's loading page that performs several parallel actions: moving and resizing the displayed logo, and then the user is sent to the homepage.
• Deletion of old reservations – every time a user logs into the site, a query is executed to delete all old reservations from the database.
• Reservations displayed on the "My Reservations" page are sorted in descending order, from the closest date to the farthest date.

Scenarios and User Interactions:
Scenario #1 – Editing a Reservation:
The user clicks on the "My Reservations" button in the navigation bar, and the "My Reservations" page is presented.
On the initial screen, the user selects which reservation they want to edit and clicks the "Edit" button for that reservation. After clicking the "Edit" button, the user is taken to the second screen, which is similar to the "New Reservation" page on the site. On this screen, the user can select a date, and available seats for that date will be displayed. After making changes, the user submits the updated reservation to the database. The system informs the user that the reservation has been updated successfully and returns them to the "My Reservations" page.

Scenario #2 – Reporting:
Frequently, issues arise at employee workstations that need maintenance. Users can report such issues to the office management through the website. The user clicks on the "Report" button in the navigation bar and is presented with a reporting form. In the report form, the user must fill in their name, email, phone number, floor, seat, date of the issue, time of the issue, and a detailed description of the problem. If desired, the user can also upload a picture of the workstation. The form includes a CAPTCHA verification to ensure it is submitted by a human. After filling out the form, the user clicks the "Submit" button at the bottom of the page. The user receives an indication of the email submission upon success.
