html = input("Enter the html : ")    

inOption = False
brand = ""

for l in html:
    if(l == '>'):
        brand = ""
        inOption = True
    if(l == '<'):
        inOption = False
        brand = brand.replace('&nbsp;', '')
        if(brand != '>'):
            print(brand[1:])
    if(inOption):
        brand += l 