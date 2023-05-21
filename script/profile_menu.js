var sse1 = function () {
    var rebound = 20; //set it to 0 if rebound effect is not preferred
    var slip, k;

    function loadContent(event, option) {
      event.preventDefault();
      switch (option) {
        case 'my-tickets':
          //console.log('Loading My Tickets content...');
          var xhr = new XMLHttpRequest();
          xhr.open('GET', '../api/getMyTickets.php', true);
          xhr.onreadystatechange = function () {
            console.log(xhr.readyState);
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                console.log(xhr.responseText);
              var tickets = JSON.parse(xhr.responseText);
              document.getElementById('ticket_list').innerHTML = '';
              // Process the retrieved tickets and update the content
              // For example, you can iterate over the tickets and create HTML elements to display them
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

                // Create the hashtags container div
                var departmentContainerDiv = document.createElement('div');
                departmentContainerDiv.id = 'hashtags_container';

                // Create the hashtags paragraph
                var departmentParagraph = document.createElement('p');
                departmentParagraph.id = 'hashtags';

                departmentParagraph.textContent = 'Department: ';

                // Loop through the hashtags array and create the text content
                /*var departmentString = '';
                for (var i = 0; i < ticket.department.length; i++) {
                    departmentString += ticket.department[i] + ' ';
                }*/



                // Set the text content of the paragraph element
                departmentParagraph.textContent += ticket.department;

                // Loop through the hashtags array and create the hashtags string
                //var hashtagsString = '';
                /*<?php foreach ($ticket->hashtags as $hashtag): ?>
                hashtagsString += '<?= $hashtag ?> ';
                <?php endforeach; ?>
                hashtagsParagraph.textContent = 'Hashtags: ' + hashtagsString;*/


                // Append the hashtags paragraph to the hashtags container div
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

                // Append the hashtags container div and date container div to the footer
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
          };
          xhr.send();
          break;
        case 'users':
          console.log('Loading Users content...');
          var xhr = new XMLHttpRequest();
xhr.open('GET', '../api/getUsers.php', true);
xhr.onreadystatechange = function () {
  if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    console.log(xhr.responseText);
    var users = JSON.parse(xhr.responseText);

    var content = document.getElementById('user_list');
    content.innerHTML = '';

    for (var i = 0; i < users.length; i++) {
      var user = users[i];

      // Create card element
      var card = document.createElement("div");
      card.className = "card";

      // Create heading element
      var heading = document.createElement("h2");
      heading.textContent = "User Information";

      // Create username paragraph element
      var usernameParagraph = document.createElement("p");
      var usernameStrong = document.createElement("strong");
      usernameStrong.textContent = "Username: ";
      usernameParagraph.appendChild(usernameStrong);
      usernameParagraph.appendChild(document.createTextNode(user.username));

      // Create email paragraph element
      var emailParagraph = document.createElement("p");
      var emailStrong = document.createElement("strong");
      emailStrong.textContent = "Email: ";
      emailParagraph.appendChild(emailStrong);
      emailParagraph.appendChild(document.createTextNode(user.email));

      // Create type paragraph element
      var typeParagraph = document.createElement("p");
      var typeStrong = document.createElement("strong");
      typeStrong.textContent = "Type: ";
      typeParagraph.appendChild(typeStrong);
      typeParagraph.appendChild(document.createTextNode(user.typestr));

      // Create form element
      var form = document.createElement("form");
      form.action = "../actions/action_update_user_type.php";
      form.method = "POST";

        var userIdInput = document.createElement("input");
        userIdInput.type = "hidden";
        userIdInput.name = "userId";
        userIdInput.value = user.id;

      // Create select element for user type
      var userTypeSelect = document.createElement("select");
      userTypeSelect.name = "userType";

      // Create options for user type
      var adminOption = document.createElement("option");
      adminOption.value = "Admin";
      adminOption.textContent = "Admin";

      var agentOption = document.createElement("option");
      agentOption.value = "Agent";
      agentOption.textContent = "Agent";

      var clientOption = document.createElement("option");
      clientOption.value = "Client";
      clientOption.textContent = "Client";

      // Append options to the select element
      userTypeSelect.appendChild(adminOption);
      userTypeSelect.appendChild(agentOption);
      userTypeSelect.appendChild(clientOption);

      // Create submit button
      var submitButton = document.createElement("button");
      submitButton.type = "submit";
      submitButton.textContent = "Submit";

      // Append select element and button to the form
      form.appendChild(userIdInput);
      form.appendChild(userTypeSelect);
      form.appendChild(submitButton);

      // Append elements to the card
      card.appendChild(heading);
      card.appendChild(usernameParagraph);
      card.appendChild(emailParagraph);
      card.appendChild(typeParagraph);
      card.appendChild(form);

      var container = document.getElementById('user_list');
      container.appendChild(card);
    }
  }
};
xhr.send();
          break;
        case 'web-menus':
          document.getElementById('ticket_list').innerHTML = '';
          console.log('Loading Web Menus content...');
          break;
        default:
          break;
      }
    }

    return {
      buildMenu: function () {
        var m = document.getElementById('sses1');
        if (!m) return;
        var ul = m.getElementsByTagName("ul")[0];
        m.style.width = ul.offsetWidth + 1 + "px";
        var items = m.getElementsByTagName("li");
        var a = m.getElementsByTagName("a");

        slip = document.createElement("li");
        slip.className = "highlight";
        ul.appendChild(slip);

        var url = document.location.href.toLowerCase();
        k = -1;
        var nLength = -1;
        for (var i = 0; i < a.length; i++) {
          if (url.indexOf(a[i].href.toLowerCase()) != -1 && a[i].href.length > nLength) {
            k = i;
            nLength = a[i].href.length;
          }
        }

        if (k == -1 && /:\/\/(?:www\.)?[^.\/]+?\.[^.\/]+\/?$/.test) {
          for (var i = 0; i < a.length; i++) {
            if (a[i].getAttribute("maptopuredomain") == "true") {
              k = i;
              break;
            }
          }
          if (k == -1 && a[0].getAttribute("maptopuredomain") != "false")
            k = 0;
        }

        if (k > -1) {
          slip.style.width = items[k].offsetWidth + "px";
          sse1.move(items[k]);
        } else {
          slip.style.visibility = "hidden";
        }

        for (var i = 0; i < items.length - 1; i++) {
          items[i].onmouseover = function () {
            if (k == -1) slip.style.visibility = "visible";
            if (this.offsetLeft != slip.offsetLeft) {
              sse1.move(this);
            }
          }
        }

        m.onmouseover = function () {
          if (slip.t2)
            slip.t2 = clearTimeout(slip.t2);
        };

        m.onmouseout = function () {
          if (k > -1 && items[k].offsetLeft != slip.offsetLeft) {
            slip.t2 = setTimeout(function () { sse1.move(items[k]); }, 50);
          }
          if (k == -1) slip.t2 = setTimeout(function () { slip.style.visibility = "hidden"; }, 50);
        };
      },
      move: function (target) {
        clearInterval(slip.timer);
        var direction = (slip.offsetLeft < target.offsetLeft) ? 1 : -1;
        slip.timer = setInterval(function () { sse1.mv(target, direction); }, 15);
      },
      mv: function (target, direction) {
        if (direction == 1) {
          if (slip.offsetLeft - rebound < target.offsetLeft)
            this.changePosition(target, 1);
          else {
            clearInterval(slip.timer);
            slip.timer = setInterval(function () {
              sse1.recoil(target, 1);
            }, 15);
          }
        }
        else {
          if (slip.offsetLeft + rebound > target.offsetLeft)
            this.changePosition(target, -1);
          else {
            clearInterval(slip.timer);
            slip.timer = setInterval(function () {
              sse1.recoil(target, -1);
            }, 15);
          }
        }
        this.changeWidth(target);
      },
      recoil: function (target, direction) {
        if (direction == -1) {
          if (slip.offsetLeft > target.offsetLeft) {
            slip.style.left = target.offsetLeft + "px";
            clearInterval(slip.timer);
          }
          else slip.style.left = slip.offsetLeft + 2 + "px";
        }
        else {
          if (slip.offsetLeft < target.offsetLeft) {
            slip.style.left = target.offsetLeft + "px";
            clearInterval(slip.timer);
          }
          else slip.style.left = slip.offsetLeft - 2 + "px";
        }
      },
      changePosition: function (target, direction) {
        if (direction == 1) {
          slip.style.left = slip.offsetLeft + Math.ceil(Math.abs(target.offsetLeft - slip.offsetLeft + rebound) / 10) + 1 + "px";
        }
        else {
          slip.style.left = slip.offsetLeft - Math.ceil(Math.abs(slip.offsetLeft - target.offsetLeft + rebound) / 10) - 1 + "px";
        }
      },
      changeWidth: function (target) {
        if (slip.offsetWidth != target.offsetWidth) {
          var diff = slip.offsetWidth - target.offsetWidth;
          if (Math.abs(diff) < 4) slip.style.width = target.offsetWidth + "px";
          else slip.style.width = slip.offsetWidth - Math.round(diff / 3) + "px";
        }
      },
      loadContent: loadContent
    };
  }();

  window.loadContent = sse1.loadContent;

  if (window.addEventListener) {
    window.addEventListener("load", sse1.buildMenu, false);
  } else if (window.attachEvent) {
    window.attachEvent("onload", sse1.buildMenu);
  } else {
    window["onload"] = sse1.buildMenu;
  }