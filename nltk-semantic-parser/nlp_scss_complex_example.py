# Download the Stanford CoreNLP:
# https://stanfordnlp.github.io/CoreNLP/download.html

# Run the following command to start the CoreNLP server:
# java -cp "~\Studio\Development\_\NLP\*:stanford-corenlp-4.5.7.jar" edu.stanford.nlp.pipeline.StanfordCoreNLPServer -port 9000

import nltk

from nltk.parse import CoreNLPParser

# Initialize CoreNLP parser
parser = CoreNLPParser(url='http://localhost:9000')

# Parse the sentence
sentence = "The girl who wore a red dress quickly ran to the store because she forgot her keys."
parse_tree = list(parser.raw_parse(sentence))

# Extract and print the parse tree
# print(parse_tree)
for tree in parse_tree:
    print(tree)
