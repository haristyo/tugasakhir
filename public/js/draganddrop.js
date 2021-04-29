function onDragStart(event) {
	const id = event.target.id;
	const ide = id.split("-");
	event.dataTransfer.setData('text/plain', id);
	event.dataTransfer.effectAllowed = "move";
	}
function onDragOverBacklog(event) {
		const itemover = event.dataTransfer.getData('text/plain');
		const itemovers = itemover.split("-");
		event.dataTransfer.dropEffect = "move";
	event.preventDefault();
	if(itemovers=='item') {
	}
}
function onDropBacklog(event) {
	event.preventDefault();
	const itemover = event.dataTransfer.getData('text/plain');
		const itemovers = itemover.split("-");
		const id_backlog = itemovers[1];
		const sprint =  event.target.id;
		const sprints = sprint.split("-");
		var id_sprint = sprints[1];
		var tipe = sprints[0];
		console.log(base_url);
		if(itemovers[0]=='item' ){
			if(sprints!='' && tipe=='backlog' ) {
			event.target.appendChild(document.getElementById(itemover));
			$.ajax({
				url: base_url+'/proyek/editdragbacklog',
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
		const itemovers = itemover.split("-");
		event.dataTransfer.dropEffect = "move";
	event.preventDefault();
	if(itemovers=='epic') {
	}
}
function onDropEpic(event) {
	event.preventDefault();
	const itemover = event.dataTransfer.getData('text/plain');
		const itemovers = itemover.split("-");
		const id_epic = itemovers[1];
		const status = event.target.id;
		const statuses = status.split("-");
		if(itemovers[0]=='epic'){
			if (statuses!='' && statuses[0]!='epic') {
				event.target.appendChild(document.getElementById(itemover));
			$.ajax({
				url: base_url+'/proyek/editdragepic',
				type: 'POST',
				data: {'id_epic':id_epic,'status':statuses[0]},
				success: function(response){
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