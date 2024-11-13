#!/bin/bash

# Variables
URL="http://yourdomain.com/path/to/your/page.php"  # Replace with your actual URL
CRON_SCHEDULE="* * * * *"  # Set the cron schedule here (this example runs every minute)
CRON_CMD="wget -q -O /dev/null $URL"  # The command to run the PHP page

# Check if the cron job is already set, if not, add it
(crontab -l 2>/dev/null; echo "$CRON_SCHEDULE $CRON_CMD") | crontab -
