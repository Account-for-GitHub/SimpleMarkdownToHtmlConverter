

	/* listen for keyup on text_input_area */
	let update_html_output_area = (this_textarea) => {
		let markdown_text = this_textarea.value
		
		let content_data = JSON.stringify({
			"markdown_text": markdown_text
		})
		
		let headers = {
			'Content-Type': 'application/json;charset=utf-8'
		}
		
		let request_data = {
			method: 'POST',
			headers: headers,
			body: content_data
		}
		
		fetch('https://localhost:8000/spa_api', request_data)
		.then(response => response.json())
		.then(result => html_content_output(result))
		
	}

	/* output result html content */
	let html_content_output = (json_content) => {
		let result_object = JSON.parse(json_content)
		if(result_object.html_content === undefined){
			return false
		}
		let html_content = result_object.html_content
		document.getElementById('html_output_area').innerHTML = html_content
	}