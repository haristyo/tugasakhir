
function onDragStart(event) {
	const id = event.target.id;
	// console.log(id);
	const ide = id.split("-");
	// console.log(ide[0]);
	// alert(ide[0]);
	// alert("hulalalal");
	event.dataTransfer.setData('text/plain', id);
	event.dataTransfer.effectAllowed = "move";
	}

	

	  
function onDragOverBacklog(event) {
		const itemover = event.dataTransfer.getData('text/plain');
		// console.log(itemover);
		const itemovers = itemover.split("-");
		// console.log(itemovers);
		event.dataTransfer.dropEffect = "move";
		// alert(event.target.id);

		// const item = item.split("-");
		// const pecah = item[0];
		// if (pecah)
		// document.getElementById("demo").innerHTML = pecah;
	//   alert(event.target.id);
	event.preventDefault();
	if(itemovers=='item') {

	}
	// alert($event);
}
function onDropBacklog(event) {
	
	event.preventDefault();
	const itemover = event.dataTransfer.getData('text/plain');
		// console.log(itemover);
		const itemovers = itemover.split("-");
		// console.log(itemovers[0]);
		const id_backlog = itemovers[1];
		// console.log(itemovers[1]);
		const sprint =  event.target.id;
		// console.log(event.target.id);
		const sprints = sprint.split("-");
		var id_sprint = sprints[1];
		var tipe = sprints[0];
		// console.log(sprints);
		
		if(itemovers[0]=='item' ){
			if(sprints!='' ) {
			event.target.appendChild(document.getElementById(itemover));
			$.ajax({
				url: 'http://localhost:8080/proyek/editdragbacklog',
				// url: 'http://scrumtool.epizy.com/proyek/editdragbacklog',
				type: 'POST',
				data: {'id_backlog':id_backlog,'sprint':id_sprint},
				success: function(response){
					window.location.reload()
				}
			});
			}
		}
		else{
			
			
			alert("Pindahkan epic ke selain backlog")
		}
	
}
function onDragOverEpic(event) {
		const itemover = event.dataTransfer.getData('text/plain');
		// console.log(itemover);
		const itemovers = itemover.split("-");
		// console.log(itemovers);
		event.dataTransfer.dropEffect = "move";
		// alert(event.target.id);

		// const item = item.split("-");
		// const pecah = item[0];
		// if (pecah)
		// document.getElementById("demo").innerHTML = pecah;
	//   alert(event.target.id);
	event.preventDefault();
	if(itemovers=='epic') {

	}
	// alert($event);
}
function onDropEpic(event) {
	event.preventDefault();
	const itemover = event.dataTransfer.getData('text/plain');
		// console.log(itemover);
		const itemovers = itemover.split("-");
		// console.log(event.target.id);
		// console.log(itemovers[0]);
		const id_epic = itemovers[1];
		const status = event.target.id;
		const statuses = status.split("-");
		// console.log(statuses);
		
		if(itemovers[0]=='epic'){
			
			if (statuses!='' && statuses[0]!='epic') {
				event.target.appendChild(document.getElementById(itemover));
			$.ajax({
				url: 'http://localhost:8080/proyek/editdragepic',
				// url: 'http://scrumtool.epizy.com/proyek/editdragepic',
				type: 'POST',
				data: {'id_epic':id_epic,'status':statuses[0]},
				success: function(response){
					// console.log('sukses');
					window.location.reload()
				}
			});
				
			}
			else {
				alert("Letakan epic tidak ke epic lainnya");
			}
			
		}
		else{
			alert("Hanya Product Backlog Item ke dalam sprint Backlog, dan sebaliknya");
		}
	
}
