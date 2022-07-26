#!/usr/bin/env python3

import json
import mysql.connector
import sys
import datetime
from web3 import Web3

url = 'https://mainnet.infura.io/v3/2b0d5ad9f5854ca5b8d168eb72477e91'

try:
    mydb = mysql.connector.connect(
        host="database",
        user="root",
        password="cdmllove",
        database="milkstore",
        auth_plugin='mysql_native_password'
    )
    mycursor = mydb.cursor()

    sql = "INSERT INTO user_wallet (user_id, address, private_key, created_at, updated_at) VALUES (%s, %s, %s, %s, %s)"

    mycursor.execute("SELECT id FROM users where need_create_wallet = 1")
    myresult = mycursor.fetchall()
    for x in myresult:
        user_id = int(x[0])
        web3 = Web3(Web3.HTTPProvider(url))
        account = web3.eth.account.create()
        address = account.address
        privateKey = account.privateKey.hex()

        now = datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')
        val = (user_id, address, privateKey, now, now)
        mycursor.execute(sql, val)
        mycursor.execute('UPDATE users SET need_create_wallet = 0 WHERE id = ' + str(user_id))
        mydb.commit()

    print('Done')
except Exception as e:
    print(e)
