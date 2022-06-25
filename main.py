from flask import Flask
from website import app

if __name__=="__main__":
    app.secret_key="2548646545454sfdsg"
    app.run(debug=True)
