function printWages(result) {
	for (var i = 0; i < result.length; i++) {
		var wage = result[i];
		addPrintWage(wage.wageId, wage.projectId, wage.person, wage.start, wage.end, wage.description);
	}
}

function addPrintWage(wageId, projectId, person, start, end, description) {
	var table = document.getElementById('wages');
	
	var tr = document.createElement('tr');
	tr.id = wageId;
	tr.classList.add(projectId);
	
	var tdPerson = document.createElement('td');
	tdPerson.innerText = person;
	
	var tdDate = document.createElement('td');
	tdDate.innerText = getDate(start);
	
	var tdStart = document.createElement('td');
	tdStart.innerText = getTime(start);
	
	var tdEnd = document.createElement('td');
	tdEnd.innerText = getTime(end);
	
	var tdHours = document.createElement('td');
	var hours = getHours(start, end);
	tdHours.innerText = hours.replace('.', ',');
	
	var tdDescription = document.createElement('td');
	tdDescription.innerText = description;
	
	tr.appendChild(tdPerson);
	tr.appendChild(tdDate);
	tr.appendChild(tdStart);
	tr.appendChild(tdEnd);
	tr.appendChild(tdHours);
	tr.appendChild(tdDescription);
	
	table.appendChild(tr);
};

function buildWages(result) {
	for (var i = 0; i < result.length; i++) {
		var wage = result[i];
		addWage(wage.wageId, wage.projectId, wage.person, wage.start, wage.end, wage.description);
	}
}

function addNewWage(result) {
	var wage = result;
	addWage(wage.wageId, wage.projectId, wage.person, wage.start, wage.end, wage.description);
}

function addWage(wageId, projectId, person, start, end, description) {
	var table = document.getElementById('wages');
	
	var tr = document.createElement('tr');
	tr.id = wageId;
	tr.classList.add(projectId);
	
	var tdPerson = document.createElement('td');
	var pPerson = document.createElement('p');
	pPerson.innerText = person;
	tdPerson.appendChild(pPerson);
	
	var tdDate = document.createElement('td');
	var pDate = document.createElement('p');
	pDate.innerText = getDate(start);
	tdDate.appendChild(pDate);
	
	var tdStart = document.createElement('td');
	var pStart = document.createElement('p');
	pStart.innerText = getTime(start);
	tdStart.appendChild(pStart);
	
	var tdEnd = document.createElement('td');
	var pEnd = document.createElement('p');
	pEnd.innerText = getTime(end);
	tdEnd.appendChild(pEnd);
	
	var tdHours = document.createElement('td');
	var pHours = document.createElement('p');
	pHours.innerText = getHours(start, end);
	tdHours.appendChild(pHours);
	
	var tdDescription = document.createElement('td');
	var pDescription = document.createElement('p');
	pDescription.innerText = description;
	tdDescription.appendChild(pDescription);
	
	var tdEdit = document.createElement('td');
	tdEdit.classList.add('img');
	tdEdit.innerHTML = '<img src="../view/img/edit.png" width="19" onclick="wageWrite(this.parentNode.parentNode);" />';
	
	var tdDelete = document.createElement('td');
	tdDelete.classList.add('img');
	tdDelete.innerHTML = '<img src="../view/img/x.png" width="19" onclick="deleteWage(this.parentNode.parentNode);" />';
	
	tr.appendChild(tdPerson);
	tr.appendChild(tdDate);
	tr.appendChild(tdStart);
	tr.appendChild(tdEnd);
	tr.appendChild(tdHours);
	tr.appendChild(tdDescription);
	tr.appendChild(tdEdit);
	tr.appendChild(tdDelete);
	
	table.appendChild(tr);
};

function wageWrite(row) {
	var tdPerson = row.children[0];
	var selPerson = document.createElement('select');
	selPerson.classList.add('w80');
	selPerson.options[0] = new Option('Andreas', 'Andreas');
	selPerson.options[1] = new Option('Thomas', 'Thomas');
	selPerson.value = tdPerson.innerText;
	while (tdPerson.firstChild) {
	    tdPerson.removeChild(tdPerson.firstChild);
	}
	tdPerson.appendChild(selPerson);
	
	var tdDate = row.children[1];
	var inpDate = document.createElement('input');
	inpDate.classList.add('w74');
	inpDate.type = 'text';
	inpDate.value = tdDate.innerText;
	while (tdDate.firstChild) {
		tdDate.removeChild(tdDate.firstChild);
	}
	tdDate.appendChild(inpDate);
	
	var tdStart = row.children[2];
	var inpStart = document.createElement('input');
	inpStart.classList.add('w54');
	inpStart.type = 'text';
	inpStart.value = tdStart.innerText;
	while (tdStart.firstChild) {
		tdStart.removeChild(tdStart.firstChild);
	}
	tdStart.appendChild(inpStart);
	
	var tdEnd = row.children[3];
	var inpEnd = document.createElement('input');
	inpEnd.classList.add('w54');
	inpEnd.type = 'text';
	inpEnd.value = tdEnd.innerText;
	while (tdEnd.firstChild) {
		tdEnd.removeChild(tdEnd.firstChild);
	}
	tdEnd.appendChild(inpEnd);
	
	var tdHours = row.children[4];
	var inpHours = document.createElement('input');
	inpHours.classList.add('w54');
	inpHours.type = 'text';
	inpHours.value = tdHours.innerText;
	inpHours.readOnly = true;
	while (tdHours.firstChild) {
		tdHours.removeChild(tdHours.firstChild);
	}
	tdHours.appendChild(inpHours);
	
	var tdDescription = row.children[5];
	var inpDescription = document.createElement('input');
	inpDescription.classList.add('w234');
	inpDescription.type = 'text';
	inpDescription.value = tdDescription.innerText;
	while (tdDescription.firstChild) {
		tdDescription.removeChild(tdDescription.firstChild);
	}
	tdDescription.appendChild(inpDescription);
	
	var tdEdit = row.children[6];
	tdEdit.innerHTML = '<img src="../view/img/v.png" width="19" onclick="wageRead(this.parentNode.parentNode);" />';
};

function wageRead(row) {
	request('saveWage.php', ['event', 'wageId', 'projectId', 'person', 'date', 'start', 'end', 'description'],
			['save',
			 row.id,
			 row.className,
			 row.children[0].children[0].value,
			 row.children[1].children[0].value,
			 row.children[2].children[0].value,
			 row.children[3].children[0].value,
			 row.children[5].children[0].value]);
	
	var tdPerson = row.children[0];
	var selPerson = tdPerson.children[0];
	var pPerson = document.createElement('p');
	pPerson.innerText = selPerson.value;
	while (tdPerson.firstChild) {
	    tdPerson.removeChild(tdPerson.firstChild);
	}
	tdPerson.appendChild(pPerson);
	
	var tdDate = row.children[1];
	var inpDate = tdDate.children[0];
	var pDate = document.createElement('p');
	pDate.innerText = inpDate.value;
	while (tdDate.firstChild) {
	    tdDate.removeChild(tdDate.firstChild);
	}
	tdDate.appendChild(pDate);
	
	var tdStart = row.children[2];
	var inpStart = tdStart.children[0];
	var pStart = document.createElement('p');
	pStart.innerText = inpStart.value.replace('.', ':');
	while (tdStart.firstChild) {
		tdStart.removeChild(tdStart.firstChild);
	}
	tdStart.appendChild(pStart);
	
	var tdEnd = row.children[3];
	var inpEnd = tdEnd.children[0];
	var pEnd = document.createElement('p');
	pEnd.innerText = inpEnd.value.replace('.', ':');
	while (tdEnd.firstChild) {
		tdEnd.removeChild(tdEnd.firstChild);
	}
	tdEnd.appendChild(pEnd);
	
	var tdHours = row.children[4];
	var inpHours = getHours(getUnix('01.01.1970', tdStart.innerText), getUnix('01.01.1970', tdEnd.innerText));
	var pHours = document.createElement('p');
	pHours.innerText = inpHours;
	while (tdHours.firstChild) {
		tdHours.removeChild(tdHours.firstChild);
	}
	tdHours.appendChild(pHours);
	
	var tdDescription = row.children[5];
	var inpDescription = tdDescription.children[0];
	var pDescription = document.createElement('p');
	pDescription.innerText = inpDescription.value;
	while (tdDescription.firstChild) {
		tdDescription.removeChild(tdDescription.firstChild);
	}
	tdDescription.appendChild(pDescription);
	
	var tdEdit = row.children[6];
	tdEdit.innerHTML = '<img src="../view/img/edit.png" width="19" onclick="wageWrite(this.parentNode.parentNode);" />';
};

function saveWage(row) {
	var wageId = row.id;
	var projectId = row.className;
	var person = row.children[0].children[0].value;
	var date = row.children[1].children[0].value;
	var start = row.children[2].children[0].value;
	var end = row.children[3].children[0].value;
	var description = row.children[5].children[0].value;
	
	request('saveWage.php', ['event', 'wageId', 'projectId', 'person', 'date', 'start', 'end', 'description'],
			['save', wageId, projectId, person, date, start, end, description], addNewWage);
	
	row.children[1].children[0].value = '';
	row.children[2].children[0].value = '';
	row.children[3].children[0].value = '';
	row.children[4].children[0].value = '';
	row.children[5].children[0].value = '';
	row.children[6].children[0].value = '';
}

function deleteWage(row) {
	if (confirm("Er du sikker på at du vil slette denne linjen?")) {
		request('saveWage.php', ['event', 'wageId'], ['delete', row.id]);
		row.parentNode.removeChild(row);
	}
}


/**
 * 
 * @param fileName as string (including ".php")
 * @param vars as array (GET variable names)
 * @param values as array (GET values)
 * @param handleResult as function
 */
function request(fileName, vars, values, handleResult) {
	if (fileName && vars instanceof Array && values instanceof Array && vars.length === values.length) {
		var adress = '../controller/' + fileName + '?';
		for (var i = 0; i < vars.length; i++) {
			adress += vars[i] + '=' + encodeURIComponent(values[i]) + '&';
		}
		adress += 'key=' + Date.now();
		
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open('GET', adress, true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				if (handleResult) {
					if (!xmlhttp.responseText) handleResult(xmlhttp.responseText);
					else handleResult(JSON.parse(xmlhttp.responseText));
				}
			}
		};
	}
	else {
		handleResult(null);
	}
};

/**
 * 
 * @param start in seconds
 * @param end in seconds
 * @returns Hours between the times
 */
function getHours(start, end) {
	var hours = (end - start) / 3600;
	
	return hours.toFixed(2);
};

/**
 * 
 * @param date dd.mm.yyyy
 * @param time hh:mm
 * @returns Unix timestamp
 */
function getUnix(date, time) {
	var dateArray = date.split('.');
	var day = dateArray[0];
	var month = dateArray[1];
	var year = dateArray[2];
	var unix = new Date(year + '/' + month + '/' + day).getTime() / 1000;
	if (time) unix = new Date(year + '/' + month + '/' + day + ' ' + time).getTime() / 1000;
	
	return unix;
};

/**
 * 
 * @param unix timestamp
 * @returns formatted date as dd.mm.yyyy
 */
function getDate(unix) {
	var date = new Date(unix * 1000);
	var day = this.pad(date.getDate());
	var month = this.pad(date.getMonth() + 1);
	var year = date.getFullYear();
	date = day + "." + month + "." + year;
	
	return date;
};

/**
 * 
 * @param unix timestamp
 * @returns formatted time as hh:mm
 */
function getTime(unix) {
	var date = new Date(unix * 1000);
	var hours = this.pad(date.getHours());
	var minutes = this.pad(date.getMinutes());
	var time = hours + ":" + minutes;
	
	return time;
};

/**
 * 
 * @param n
 * @returns dobbel-digit
 */
function pad(n) {
    return (n < 10) ? ('0' + n) : n;
};