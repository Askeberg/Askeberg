function buildWages(result) {
	for (var i = 0; i < result.length; i++) {
		var wage = result[i];
		addWage(wage.wageId, wage.projectId, wage.person, wage.date, wage.hours, wage.description);
	}
}

function addNewWage(result) {
	var wage = result;
	addWage(wage.wageId, wage.projectId, wage.person, wage.date, wage.hours, wage.description);
}

function addWage(wageId, projectId, person, date, hours, description) {
	var table = document.getElementById('wages');
	
	var tr = document.createElement('tr');
	tr.id = wageId;
	tr.classList.add(projectId);
	
	var tdPerson = document.createElement('td');
	tdPerson.innerText = person;
	
	var tdDate = document.createElement('td');
	tdDate.innerText = getDate(date);
	
	var tdHours = document.createElement('td');
	tdHours.innerText = hours;
	
	var tdDescription = document.createElement('td');
	tdDescription.innerText = description;
	
	var tdEdit = document.createElement('td');
	tdEdit.classList.add('img');
	tdEdit.innerHTML = '<img src="../view/img/edit.png" width="19" onclick="wageWrite(this.parentNode.parentNode);" />';
	
	var tdDelete = document.createElement('td');
	tdDelete.classList.add('img');
	tdDelete.innerHTML = '<img src="../view/img/x.png" width="19" onclick="deleteWage(this.parentNode.parentNode);" />';
	
	tr.appendChild(tdPerson);
	tr.appendChild(tdDate);
	tr.appendChild(tdHours);
	tr.appendChild(tdDescription);
	tr.appendChild(tdEdit);
	tr.appendChild(tdDelete);
	
	table.appendChild(tr);
};

function wageWrite(row) {
	var tdPerson = row.children[0];
	var selPerson = document.createElement('select');
	selPerson.classList.add('w74');
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
	
	var tdHours = row.children[2];
	var inpHours = document.createElement('input');
	inpHours.classList.add('w54');
	inpHours.type = 'text';
	inpHours.value = tdHours.innerText;
	while (tdHours.firstChild) {
		tdHours.removeChild(tdHours.firstChild);
	}
	tdHours.appendChild(inpHours);
	
	var tdDescription = row.children[3];
	var inpDescription = document.createElement('input');
	inpDescription.classList.add('w234');
	inpDescription.type = 'text';
	inpDescription.value = tdDescription.innerText;
	while (tdDescription.firstChild) {
		tdDescription.removeChild(tdDescription.firstChild);
	}
	tdDescription.appendChild(inpDescription);
	
	var tdEdit = row.children[4];
	tdEdit.innerHTML = '<img src="../view/img/v.png" width="19" onclick="wageRead(this.parentNode.parentNode);" />';
};

function wageRead(row) {
	request('saveWage.php', ['submit', 'wageId', 'projectId', 'person', 'date', 'hours', 'description'],
			['save',
			 row.id,
			 row.className,
			 row.children[0].children[0].value,
			 row.children[1].children[0].value,
			 row.children[2].children[0].value,
			 row.children[3].children[0].value]);
	
	var tdPerson = row.children[0];
	var selPerson = tdPerson.children[0];
	tdPerson.innerText = selPerson.value;
	
	var tdDate = row.children[1];
	var inpDate = tdDate.children[0];
	tdDate.innerText = inpDate.value;
	
	var tdHours = row.children[2];
	var inpHours = tdHours.children[0];
	tdHours.innerText = inpHours.value;
	
	var tdDescription = row.children[3];
	var inpDescription = tdDescription.children[0];
	tdDescription.innerText = inpDescription.value;
	
	var tdEdit = row.children[4];
	tdEdit.innerHTML = '<img src="../view/img/edit.png" width="19" onclick="wageWrite(this.parentNode.parentNode);" />';
};

function saveWage(row) {
	var wageId = row.id;
	var projectId = row.className;
	var person = row.children[0].children[0].value;
	var date = row.children[1].children[0].value;
	var hours = row.children[2].children[0].value;
	var description = row.children[3].children[0].value;
	
	request('saveWage.php', ['submit', 'wageId', 'projectId', 'person', 'date', 'hours', 'description'],
			['save', wageId, projectId, person, date, hours, description], addNewWage);
	
	row.children[1].children[0].value = '';
	row.children[2].children[0].value = '';
	row.children[3].children[0].value = '';
}

function deleteWage(row) {
	var result = confirm("Er du sikker på at du vil slette denne linjen?");
	if (result) {
		request('saveWage.php', ['submit', 'wageId'], ['delete', row.id]);
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
 * @param n
 * @returns dobbel-digit
 */
function pad(n) {
    return (n < 10) ? ('0' + n) : n;
};