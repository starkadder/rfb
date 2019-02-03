wget -q -O- "http://www.npr.org/rss/podcast.php?id=510024" | grep -o '<enclosure url="[^"]*' | grep -o '[^"]*$' > /music/shows/rehm.m3u
