import requests
from pyquery import PyQuery as pq
import json
import sys
import re


class BLInterface(object):
    link = None
    result = None
    content = None
    avNum = None
    url = "https://www.bilibili.com/video/av"
    pq = None
    jsonDate = None
    cid = None

    def __init__(self, avNum):
        self.avNum = avNum
        self.url = self.url + self.avNum + "/"
        self.result = requests.get(self.url)
        self.content = self.result.content
        self.pq = pq(self.content.decode())
        pattern = re.compile(r'cid=[0-9]*')
        self.cid = pattern.search(self.content.decode()).group()[4:]
        for i in self.pq('script').items():
            if i.attr('type') == "application/ld+json":
                thejson = json.loads(i.html().replace("&quot;", '"'))
                if 'images' in thejson:
                    thejson['cid'] = self.cid
                    self.jsonDate = json.dumps(thejson)


def main(avNum):
    return BLInterface(avNum).jsonDate


if __name__ == '__main__':
    print(main(sys.argv[1]))
