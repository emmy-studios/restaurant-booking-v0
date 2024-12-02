<x-filament-widgets::widget>

    <div class="calendar">
        <header>
            <h3></h3>
            <nav>
                <button id="prev"></button>
                <button id="next"></button>
            </nav>
        </header>
        <section>
            <ul class="days">
                <li>Sun</li>
                <li>Mon</li>
                <li>Tue</li>
                <li>Wed</li>
                <li>Thu</li>
                <li>Fri</li>
                <li>Sat</li>
            </ul>
            <ul class="dates"></ul>
        </section>
    </div>

    <style>
        .calendar {
            margin: 0 auto;
            /*width: clamp(320px, 400px, 90%);*/
            /*width: 100%;
            height: 100%;*/
            padding: 1rem;
            background: #7cb518;
            border-radius: 10px;
            /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);*/
            border: 1px solid #5fad56;
        }
		.calendar header {
  			display: flex;
  			align-items: center;
  			justify-content: space-between;
		}
		.calendar nav {
  			display: flex;
  			align-items: center;
		}
		.calendar ul {
  			list-style: none;
  			display: flex;
  			flex-wrap: wrap;
  			text-align: center;
		}
		.calendar ul li {
  			width: calc(100% / 7);
  			position: relative;
  			z-index: 2;
  			aspect-ratio: 1;
  			display: flex;
  			align-items: center;
  			justify-content: center;
		}
		#prev,
		#next {
  			width: 20px;
  			height: 20px;
  			position: relative;
  			border: none;
  			background: transparent;
  			cursor: pointer;
		}
		#prev::before,
		#next::before {
  			content: "";
  			width: 50%;
  			height: 50%;
  			position: absolute;
  			top: 50%;
  			left: 50%;
  			border-style: solid;
  			border-width: 0.25em 0.25em 0 0;
  			border-color: #ccc;
		}
		#next::before {
  			transform: translate(-50%, -50%) rotate(45deg);
		}
		#prev::before {
  			transform: translate(-50%, -50%) rotate(-135deg);
		}
		#prev:hover::before,
		#next:hover::before {
  			border-color: #000;
		}
		.days {
  			font-weight: 600;
		}
		.dates li.today {
  			color: #fff;
		}
		.dates li.today::before {
  			content: "";
  			width: 2rem;
  			height: 2rem;
  			position: absolute;
  			top: 50%;
  			left: 50%;
  			transform: translate(-50%, -50%);
  			background: #000;
  			border-radius: 50%;
  			z-index: -1;
		}
		.dates li.inactive {
  			/*color: #ccc;*/
		    color: #c4d6b0;
        }
    </style>

    <script>
        const header = document.querySelector(".calendar h3");
		const dates = document.querySelector(".dates");
		const navs = document.querySelectorAll("#prev, #next");

		const months = [
  			"January",
  			"February",
  			"March",
  			"April",
  			"May",
  			"June",
  			"July",
  			"August",
  			"September",
  			"October",
  			"November",
  			"December",
		];

		let date = new Date();
		let month = date.getMonth();
		let year = date.getFullYear();

		function renderCalendar() {
  		    // first day of the month
  		    const start = new Date(year, month, 1).getDay();
  		    // last date of the month
  		    const endDate = new Date(year, month + 1, 0).getDate();
  		    // last day of the month
  		    const end = new Date(year, month, endDate).getDay();
  		    // last date of the previous month
  		    const endDatePrev = new Date(year, month, 0).getDate();

  		    let datesHtml = "";

  		    for (let i = start; i > 0; i--) {
    		    datesHtml += `<li class="inactive">${endDatePrev - i + 1}</li>`;
  		    }

  		    for (let i = 1; i <= endDate; i++) {
    		    let className = i
                    === date.getDate()
                    && month === new Date().getMonth()
                    && year === new Date().getFullYear()
        		    ? ' class="today"'
        		    : "";
    		    datesHtml += `<li${className}>${i}</li>`;
  		    }

  		    for (let i = end; i < 6; i++) {
    		    datesHtml += `<li class="inactive">${i - end + 1}</li>`;
  		    }

  		    dates.innerHTML = datesHtml;
  		    header.textContent = `${months[month]} ${year}`;
		}

		navs.forEach((nav) => {
  		    nav.addEventListener("click", (e) => {
    		    const btnId = e.target.id;

    		    if (btnId === "prev" && month === 0) {
      		        year--;
      		        month = 11;
    		    } else if (btnId === "next" && month === 11) {
      		        year++;
      	    	    month = 0;
    		    } else {
      			    month = btnId === "next" ? month + 1 : month - 1;
    		    }

    		    date = new Date(year, month, new Date().getDate());
    		    year = date.getFullYear();
    		    month = date.getMonth();

    		    renderCalendar();
  		    });
		});

		renderCalendar();
    </script>

</x-filament-widgets::widget>
