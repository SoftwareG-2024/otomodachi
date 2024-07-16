from flask import Flask, request
import json
import xml.etree.ElementTree as ET
from xml.dom import minidom
from html import escape

app = Flask(__name__)

@app.route('/save_data', methods=['POST'])
def save_data():
    # データを受け取る
    data = json.loads(request.form['data'])

    # XMLファイルが存在する場合、ファイルをロード
    try:
        tree = ET.parse('data.xml')
        root = tree.getroot()
    except FileNotFoundError:
        root = ET.Element('data')

    # 新しいデータを作成
    new_data = ET.SubElement(root, 'item')
    for key, value in data.items():
        element = ET.SubElement(new_data, key)
        element.text = escape(str(value))

    # XMLを整形
    xml_str = ET.tostring(root, 'utf-8')
    pretty_xml = minidom.parseString(xml_str).toprettyxml(indent="  ")

    # 整形したXMLを保存
    with open('data.xml', 'w') as f:
        f.write(pretty_xml)

    return 'Data saved successfully'

if __name__ == '__main__':
    app.run(debug=True)
