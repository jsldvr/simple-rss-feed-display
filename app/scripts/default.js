// Fetch JSON data and populate the posts element
fetch('./app/data/posts.json')
    .then(response => response.json())
    .then(posts => {

        const postsElement = document.getElementById('posts');
        posts.forEach(post => {

            const postElement = document.createElement('tr');
            postElement.className = 'post';

            const dateElement = document.createElement('td');
            dateElement.innerHTML = post.pubDate;

            const titleElement = document.createElement('h3');
            titleElement.textContent = post.title;

            const descriptionElement = document.createElement('p');
            descriptionElement.innerHTML = post.description;

            const linkElement = document.createElement('a');
            linkElement.href = post.link;
            linkElement.setAttribute("target", "_blank");
            linkElement.textContent = 'Read More';

            const articleElement = document.createElement("td");

            articleElement.appendChild(titleElement);
            articleElement.appendChild(descriptionElement);
            articleElement.appendChild(linkElement);

            postElement.appendChild(dateElement);
            postElement.appendChild(articleElement);

            postsElement.appendChild(postElement);
        });
    })
    .catch(error => {
        console.error('Error fetching JSON:', error);
    });