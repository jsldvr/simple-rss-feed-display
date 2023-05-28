# rssFeed

rssFeed is a PHP application that retrieves RSS feeds from various sources and saves the posts within a local JSON file. It allows you to fetch RSS feeds, store them in a structured format, and display the contents on a web page.

## Features

- Fetches RSS feeds from multiple sources
- Saves posts in a local JSON file
- Displays the contents of the JSON file on a web page
- Orders the posts by date

## Project Structure

The project structure is as follows:

```
├── app
│   └── data
│       └── posts.json
├── getRSS.php
└── index.php
```

- `app/data`: Directory to store the JSON file that contains the posts.
- `app/scripts`: Directory to store additional scripts related to the project.
- `app/style`: Directory to store CSS files for styling the web page.
- `index.php`: The main PHP script to fetch RSS feeds, save posts in the JSON file, and display them on a web page.

## Getting Started

To get started with the rssFeed project, follow these steps:

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/rssFeed.git
   ```

2. Configure the RSS feed URLs:

   Open `index.php` and update the `$feedURLs` array with the desired RSS feed URLs.

3. Set the necessary file permissions:

   Make sure the `app/data` directory has write permissions so that the PHP script can save the JSON file.

4. Run the application:

   Start your web server and access the `index.php` file through the server's URL.

## Contributing

Contributions are welcome! If you have any ideas, improvements, or bug fixes, please open an issue or submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

Feel free to modify and customize the README.md file to fit your specific project requirements and additional information you want to include.

Make sure to update the `Getting Started` section with the appropriate steps for running the application in your environment, such as configuring the RSS feed URLs and setting file permissions.

## Author's Note

I simply wanted a script that could help me maintain a news feed that isn’t a highly curated list based on my interests and likes. I enjoy reading all sorts of information throughout the internet. The RSS feeds in this project are left, center and right (and will expand). I believe in the people’s right to free speech and believe all sides should be presented if we want an educated and civil society so that “that government of the people, by the people, for the people, shall not perish from the earth.“ 

Quoted text is Abraham Lincoln, The Gettysburg Address, November 19, 1863.