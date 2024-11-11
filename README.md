# ¶ilcrow

> A tool for ingesting, data-labeling, and building rich graph knowledge bases from English prose, with an emphasis on fiction.

---

## Usecases
* Parsing English prose into semantic triples/graphs in a more accurate and machine-readable fashion than GPT models
  * Hybrid approach to data labeling using a combination of SpaCy, the Natural Language Toolkit, and manual labeling and QA via a clean and accessible UI/UX
* Create more accurate knowledge graphs for finetuning models and for training models on personal data GraphRAG
  * GraphRAG creates PKGs through application of an LLM and is highly unreliable because of that early step in the process
  * This technique would create knowledge graphs through open-source NLP tools and manual labeling, editing, and approval
  * This would then improve the results of GraphRAG
* Create a copy editing application for fiction publishers
  * Easily label data while writing or copy editing, building a graph knowledge base while performing typical duties
  * Improve editing quality through co-reference resolution (e.g. character nickname/alias consistency; event logging as triples; etc.)
  * Improve editing quality through style logging for enforced consistency (e.g. use of em dashses `—` vs. en dashes `–`)
* Create and combine semantic knowledge bases from multiple works
  * Easier fictitious milieu "fact"-checking and consistency
  * More accurate sumamrization than LLMs
* Combine with LLMs to pursue the Allegrograph model: https://www.youtube.com/watch?v=SPcORwxMEKc
  * Add datetime to all graph triples
  * Implement reification (triples nested as a single entity in broader tirples)
  * LLM for building SPARQL queries
