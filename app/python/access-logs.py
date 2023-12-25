import json
from datetime import datetime

with open('../../app/data/access-log.json', 'r') as file:
    data = json.load(file)

# return the number of items in the list
filtered_data = len(data)
print("Pageviews:", filtered_data)

# return the number of unique _user_fingerprint
user_fingerprints = [item['_user_fingerprint'] for item in data if '_user_fingerprint' in item]
unique_user_fingerprints = set(user_fingerprints)
number_of_unique_user_fingerprints = len(unique_user_fingerprints)
print("Unique Visitors:", number_of_unique_user_fingerprints)

# return the number of unique session ids
session_ids = [item['_session_id'] for item in data if '_session_id' in item]
unique_session_ids = set(session_ids)
number_of_unique_session_ids = len(unique_session_ids)
print("Sessions:", number_of_unique_session_ids)

# return the number of unique "http_user_language" entries
http_user_languages = [item['http_user_language'] for item in data if 'http_user_language' in item]
unique_http_user_languages = set(http_user_languages)
number_of_unique_http_user_languages = len(unique_http_user_languages)
print("User languages:", number_of_unique_http_user_languages)

# for entries with datetime, return the start date and end date of the stored data
datetime_format = '%Y%m%dT%H%M%SZ'
datetimes = [datetime.strptime(item['datetime'], datetime_format) for item in data if 'datetime' in item]
start_date = min(datetimes)
end_date = max(datetimes)
start_date_str = start_date.strftime("%m/%d/%Y")
end_date_str = end_date.strftime("%m/%d/%Y")
print("Start date:", start_date_str, "-- End date:", end_date_str)
