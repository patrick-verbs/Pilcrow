import nltk
from nltk import pos_tag
from nltk.tokenize import word_tokenize

nltk.download('punkt')
nltk.download('averaged_perceptron_tagger')

sentence = "The boy lifted the box."
tokens = word_tokenize(sentence)
tagged = pos_tag(tokens)
print(tagged)
