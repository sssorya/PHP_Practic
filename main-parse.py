from bs4 import BeautifulSoup

# Opens and reads the xml file we saved earlier
with open('element.xml', 'r') as f:
    file = f.read()

# Initializing soup variable
soup = BeautifulSoup(file, 'xml')

# Storing <name> tags and elements in names variable
names = soup.find_all('name')

# Storing <age> tags and elements in 'ages' variable
ages = soup.find_all('key')

# Storing <subject> tags and elements in 'subjects' variable
subjects = soup.find_all('price')

# Displaying data in tabular format
print('-'.center(35, '-'))
print('|' + 'Name'.center(15) + '|' + ' Key ' + '|' + 'Price'.center(11) + '|')
for i in range(0, len(names)):
    print('-'.center(35, '-'))
    print(
        f'|{names[i].text.center(15)}|{ages[i].text.center(5)}|{subjects[i].text.center(11)}|')
print('-'.center(35, '-'))
