<script>
function SingleLinkList () {
	var Node = function(data){
		this.data = data;
		this.next = null;
	}

	var length = 0;
	var header = null;

	this.append = function(data)
	{
		var newNode = new Node(data);
		if (header) {
			var currentNode = header;
			while(currentNode.next){
				currentNode = currentNode.next;
			}
			currentNode.next = newNode;
		} else {
			header = newNode;
		}
		length++;
	}

	this.showList = function()
	{
		var currentNode = header;
		while(currentNode.next){
			console.log(currentNode.data);
			currentNode = currentNode.next;
		}
		console.log(currentNode.data);
	}

	this.delete = function(location)
	{
		if (location > length || location <= 0) {
			return null;
		}

		if (location == 1) {
			header = header.next
			return null;
		}

		var currentNode = header;
		var i = 2;
		while(currentNode.next){
			if (i === location) {
				currentNode.next = currentNode.next.next;
				break;
			}
			currentNode = currentNode.next;
			i++;
		}
	}

	this.appendByLocation = function(location, data)
	{
		if (location <=0 || location > length) {
			return null;
		}

		var currentNode = header;
		var i = 1;
		var newNode = new Node(data)
		while(currentNode.next){
			if (i == location) {
				newNode.next = currentNode.next;
				currentNode.next = newNode;
				break;
			}
			currentNode = currentNode.next;
			i++;
		}

		if (currentNode.next === null) {
			currentNode.next = newNode;
		}
	}
}
</script>


