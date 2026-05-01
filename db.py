import mysql.connector

def get_db_connection():
    return mysql.connector.connect(
        host="localhost",    # Replace with your host
        user="root",    # Replace with your username
        password="",  # Replace with your password
        database="canvas"     # Replace with your database name
    )
