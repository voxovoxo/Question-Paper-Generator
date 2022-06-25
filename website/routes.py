from flask.app import Flask
from flask.helpers import make_response
from flask.wrappers import Response
from website import app
from flask import render_template,flash,jsonify, request,session,logging,url_for,redirect
from sqlalchemy import create_engine
from sqlalchemy.orm import scoped_session,sessionmaker
from flask_mysqldb import MySQL, MySQLdb
from passlib.hash import sha256_crypt
import pdfkit
from random import randint

engine = create_engine("mysql+pymysql://root:@localhost/vardhanika")
#(mysql)
db=scoped_session(sessionmaker(bind=engine))

app.config['MYSQL_HOST'] ='localhost'
app.config['MYSQL_USER'] ='root'
app.config['MYSQL_PASSWORD'] =''
app.config['MYSQL_DB'] ='vardhanika'

mysql= MySQL(app)


@app.route('/')
@app.route('/index.html')
def index():
    return render_template('index.html')

@app.route('/about.html')
def about():
    return render_template('about.html',title='about')

@app.route('/contact.html', methods=["GET","POST"])
def contact():
    if request.method == "POST":
       fname = request.form.get("fname")
       lname = request.form.get("lname")
       areacode = request.form.get("areacode")
       telephone = request.form.get("telephone")
       email = request.form.get("email")
       query = request.form.get("query")
       if fname is None:
           return redirect(url_for('contact'))
       else:
           db.execute("INSERT INTO contact(fname, lname, areacode,telephone,email,query) VALUES(:fname, :lname, :areacode, :telephone, :email, :query)",
                                     {"fname":fname, "lname":lname, "areacode":areacode, "telephone":telephone, "email":email, "query":query})
           db.commit()
           return redirect(url_for('contact'))
    return render_template('contact.html',title='contact')

@app.route('/signup.html', methods=["GET","POST"])
def signup():
    if request.method == "POST":
       email = request.form.get("email")
       username =request.form. get("username")
       password = request.form.get("password")
       confirm = request.form.get("confirm")
       secure_password = sha256_crypt.encrypt(str(password))
       
       if password == confirm:
           db.execute("INSERT INTO signup(email,username,password) VALUES(:email, :username, :password)",
                                     {"email":email, "username":username, "password":secure_password})
           db.commit()
           return redirect(url_for('user'))
       else:
           flash("password does not match","danger")
           return render_template("signup.html")

    return render_template("signup.html")
    
@app.route('/login.html', methods=["GET", "POST"])
def login():
    if request.method == "POST":
       email = request.form.get("email")
       password = request.form.get("password")

       emaildata = db.execute("SELECT email FROM signup WHERE email=:email",{"email":email}).fetchone()
       passwordata = db.execute("SELECT password FROM signup WHERE email=:email",{"email":email}).fetchone()
       
       if emaildata is None:
           flash("No email","danger")
           return render_template("login.html")
       else:
           for passwor_data in passwordata:
               if sha256_crypt.verify(password, passwor_data):
                    flash("You are now login","success")
                    return redirect(url_for('user'))
               else:
                   flash("incorrect password","danger")
                   return render_template("login.html")

    return render_template('login.html', title='connect')

@app.route('/user.html')
def user():
    return render_template('user.html',title='user')

@app.route('/courses.html', methods=["GET","POST"])
def courses():
    if request.method == "POST":
       courses = request.form.get("courses")
       sem =request.form. get("sem")
       sub = request.form.get("sub")
       chap = request.form.get("chap")
       qtype = request.form.get("qtype")
       question = request.form.get("question")
       difficulty = request.form.get("difficulty")
       qid = request.form.get("qid")
     
       if courses is None:
           return render_template("courses.html")
       else:
           db.execute("INSERT INTO questions(courses, sem, sub, chap, qtype,qid, question, difficulty) VALUES(:courses, :sem, :sub, :chap, :qtype, :qid, :question, :difficulty)",
                                     {"courses":courses,"sem":sem,"sub":sub,"chap":chap,"qtype":qtype,"qid":qid, "question":question, "difficulty":difficulty})
           db.commit()
           return redirect(url_for('courses'))
    return render_template('courses.html',title='courses')

@app.route('/generate.php')
def generate():
    cur =mysql.connection.cursor()
    cur.execute("SELECT courses FROM questions")
    questions=cur.fetchall()
    cur.close()
    return render_template('generate.php', questions=questions)

@app.route('/list.html')
def list():
    return render_template('list.html',title='list')

@app.route('/pdf.html', methods=["GET","POST"])
def pdf():
    cur =mysql.connection.cursor()
    #2marks
    num=randint(1,7)
    cur.execute("SELECT question FROM questions WHERE qid='"+ str(num) +"' AND difficulty='Easy'")
    no=cur.fetchall()
    num1=randint(1,7)
    cur.execute("SELECT question FROM questions WHERE qid='"+ str(num1) +"' AND difficulty='Easy'")
    no1=cur.fetchall()
    num2=randint(1,7)
    cur.execute("SELECT question FROM questions WHERE qid='"+ str(num2) +"' AND difficulty='Easy'")
    no2=cur.fetchall()
    num3=randint(1,7)
    cur.execute("SELECT question FROM questions WHERE qid='"+ str(num3) +"' AND difficulty='Easy'")
    no3=cur.fetchall()
    num4=randint(1,7)
    cur.execute("SELECT question FROM questions WHERE qid='"+ str(num4) +"' AND difficulty='Easy'")
    no4=cur.fetchall()
    num5=randint(1,7)
    cur.execute("SELECT question FROM questions WHERE qid='"+ str(num5) +"' AND difficulty='Easy'")
    no5=cur.fetchall()
    #5 marks
    val=randint(1,3)
    cur.execute("SELECT question FROM questions WHERE qid='"+ str(val) +"' AND difficulty='Moderate'")
    value=cur.fetchall()
    val1=randint(1,3)
    cur.execute("SELECT question FROM questions WHERE qid='"+ str(val1) +"' AND difficulty='Moderate'")
    value1=cur.fetchall()
    val2=randint(1,3)
    cur.execute("SELECT question FROM questions WHERE qid='"+ str(val2) +"' AND difficulty='Moderate'")
    value2=cur.fetchall()
    #10 marks
    n1=randint(1,3)
    cur.execute("SELECT question FROM questions WHERE qid='"+ str(n1) +"' AND difficulty='Hard'")
    p1=cur.fetchall()
    n2=randint(1,3)
    cur.execute("SELECT question FROM questions WHERE qid='"+ str(n2) +"' AND difficulty='Hard'")
    p2=cur.fetchall()
    n3=randint(1,3)
    cur.execute("SELECT question FROM questions WHERE qid='"+ str(n3) +"' AND difficulty='Hard'")
    p3=cur.fetchall()
    
    cur.close()
    return render_template('pdf.html', no=no, no1=no1, no2=no2, no3=no3, no4=no4, no5=no5, value=value, value1=value1,value2=value2, p1=p1, p2=p2, p3=p3)


@app.route('/pdf.py')
def pdfpy():
    paper = "paper"
    html = render_template("pdf.html",paper=paper)
    pdf = pdfkit.from_file(html, False)
    response= make_response(pdf)
    response.headers['Content-Type']='application/pdf'
    response.headers['Content-Disposition']='inline; filename=output.pdf'
    return response

    return render_template('pdf.py',title='pdfpy')

@app.route('/logout.html')
def logout():
    return render_template('index.html',title='logout')

"""@app.route("/generate",methods=["POST","GET"])
def gen():  
    cursor = mysql.connection.cursor()
    cur = mysql.connection.cursor(MySQLdb.cursors.DictCursor)
    if request.method == 'POST':
        category_id = request.form['category_id'] 
        print(category_id)  
        result = cur.execute("SELECT * FROM questions WHERE courses = %s", [category_id] )
        sem = cur.fetchall()  
        OutputArray = []
        for row in sem:
            outputObj = {
                'cour': row['courses'],
                'sem': row['sem']}
            OutputArray.append(outputObj)
    return jsonify(OutputArray)"""








   


    





