function applyFilters(){
    const departmentFilter = document.getElementById("filter_department").value;
    const sortFilter = document.getElementById("filter_sort").value;
    const stateFilter = document.getElementById("filter_state").value;
    const ticketList = document.getElementById("ticket_list");

    //console.log(departmentFilter);

    ticketList.innerHTML = "";

    const request = new XMLHttpRequest();
    const url = '../api/getFilterTickets.php?department='+ departmentFilter + '&sort=' + sortFilter + '&state=' + stateFilter;
    request.open("GET", url, true);
    // Example: Setting the 'Content-Type' header
    //request.setRequestHeader('Content-Type', 'application/json');


    request.onreadystatechange = function() {
        if(request.readyState === XMLHttpRequest.DONE){
            //console.log(request.status);
            if(request.status === 200){
                console.log(request.responseText);
                const tickets = JSON.parse(request.responseText);

                //console.log("here" + tickets);

                tickets.forEach(function(ticket){
                    var date = new Date(ticket.date.date);
                    var formattedDate = date.toLocaleString('en-US', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        timeZone: ticket.date.timezone
                      });
                    /*const ticketDiv = document.createElement("div");
                    ticketDiv.className = "ticket";
                    ticketDiv.textContent = ticket.subject;

                    ticketList.appendChild(ticketDiv);*/
                    // Create the main section element
                    var section = document.createElement('section');
                    section.id = 'ticket_content';

                    // Create the ticket user div
                    var ticketUserDiv = document.createElement('div');
                    ticketUserDiv.id = 'ticket_user';

                    // Create the icon div based on the state
                    var iconDiv = document.createElement('div');
                    var stateName = ticket.state;
                    if (stateName == 'solved') {
                    iconDiv.innerHTML = '<i class="fa-solid fa-check fa-2xl" style="color: #018e42;"></i>';
                    } else if (stateName == 'assigned') {
                    iconDiv.innerHTML = '<i class="fa-solid fa-user-check fa-2xl" style="color: #f5c211;"></i>';
                    } else if (stateName == 'closed') {
                    iconDiv.innerHTML = '<i class="fa-solid fa-lock fa-2xl" style="color: #c01c28;"></i>';
                    } else if (stateName == 'open') {
                    iconDiv.innerHTML = '<i class="fa-sharp fa-solid fa-lock-open fa-2xl" style="color: #018e42;"></i>';
                    }

                    // Create the username paragraph
                    var usernameParagraph = document.createElement('p');
                    usernameParagraph.textContent = ticket.user.username;

                    // Append the icon div and username paragraph to the ticket user div
                    ticketUserDiv.appendChild(iconDiv);
                    ticketUserDiv.appendChild(usernameParagraph);

                    // Create the header element and its child anchor element
                    var div = document.createElement('div');
                    div.id = 'ticket_text';
                    var header = document.createElement('header');
                    var h1 = document.createElement('h1');
                    var anchor = document.createElement('a');
                    anchor.href = 'ticket.php?id=' + ticket.id;
                    anchor.textContent = ticket.subject;

                    h1.appendChild(anchor);

                    // Append the anchor element to the header
                    header.appendChild(h1);

                    // Create the content paragraph
                    var contentParagraph = document.createElement('p');
                    contentParagraph.textContent = ticket.content   ;

                    // Create the footer element
                    var footer = document.createElement('footer');
                    footer.id = 'ticket_footer';

                    // Create the department container div
                    var departmentContainerDiv = document.createElement('div');
                    departmentContainerDiv.id = 'department_container';

                    // Create the department paragraph
                    var departmentParagraph = document.createElement('p');
                    departmentParagraph.id = 'department';

                    departmentParagraph.textContent = 'Department: ';

                    // Loop through the department array and create the text content
                    var departmentString = ticket.department;
                    /*for (var i = 0; i < ticket.department.length; i++) {
                        departmentString += ticket.department[i] + ' ';
                    }*/
                    console.log(departmentFilter);
                    // Set the text content of the paragraph element
                    departmentParagraph.textContent += departmentString;

                    // Loop through the department array and create the department string
                    //var departmentString = '';
                    /*<?php foreach ($ticket->department as $hashtag): ?>
                    departmentString += '<?= $hashtag ?> ';
                    <?php endforeach; ?>
                    departmentParagraph.textContent = 'department: ' + departmentString;*/


                    // Append the department paragraph to the department container div
                    departmentContainerDiv.appendChild(departmentParagraph);

                    // Create the date container div
                    var dateContainerDiv = document.createElement('div');
                    dateContainerDiv.id = 'date_container';

                    // Create the date paragraph
                    var dateParagraph = document.createElement('p');
                    dateParagraph.id = 'date';
                    dateParagraph.textContent = formattedDate;

                    // Append the date paragraph to the date container div
                    dateContainerDiv.appendChild(dateParagraph);

                    // Append the department container div and date container div to the footer
                    footer.appendChild(departmentContainerDiv);
                    footer.appendChild(dateContainerDiv);

                    div.appendChild(header);
                    div.appendChild(contentParagraph);
                    div.appendChild(footer);

                    // Append the ticket user div, header, content paragraph, and footer to the section
                    section.appendChild(ticketUserDiv);
                    section.appendChild(div);


                    // Append the section to the desired container in the document
                    var container = document.getElementById('ticket_list');
                    container.appendChild(section);
                })
            }else{
                console.log("AJAX Error");
            }
        }
    };
    request.send();
}

document.getElementById("filter_department").addEventListener("change", applyFilters);
document.getElementById("filter_sort").addEventListener("change", applyFilters);
document.getElementById("filter_state").addEventListener("change", applyFilters);


applyFilters();