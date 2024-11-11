import nltk
import spacy
from nltk import pos_tag, word_tokenize
from nltk.corpus import dependency_treebank
from nltk.parse.dependencygraph import DependencyGraph

# Load SpaCy model
nlp = spacy.load("en_core_web_sm")

# Example sentence
sentence = "The boy lifted the box."

def get_nltk_scss(sentence):
    # Tokenize and tag the sentence
    tokens = word_tokenize(sentence)
    tagged = pos_tag(tokens)
    
    # Example of SCSS generation from NLTK (Simplified)
    scss_lines = []
    # Here, you would normally parse the sentence and generate SCSS
    # This example assumes a simplified hardcoded result
    scss_lines.append("[The boy] --(lifted)--> [the box]")
    
    return "\n".join(scss_lines)

def get_spacy_scss(sentence):
    doc = nlp(sentence)
    scss_lines = []

    subject = ""
    verb = ""
    obj = ""
    
    for token in doc:
        if token.dep_ == "nsubj":
            subject = token.text
        elif token.dep_ == "dobj":
            obj = token.text
        elif token.dep_ == "ROOT":
            verb = token.text

    # Format SCSS output
    scss = f"[{subject}] --({verb})--> [{obj}]"
    return scss

# Get SCSS outputs
nltk_scss = get_nltk_scss(sentence)
spacy_scss = get_spacy_scss(sentence)

# Print results
# print("NLTK SCSS:")
# print(nltk_scss)
# print("\nSpaCy SCSS:")
# print(spacy_scss)
