PROJECT_TYPE   ?= profile
PROJECT_NAME   ?= openproducer

help-openproducer: help-drupal
	@echo "make help-openproducer"
	@echo "  Print this help message."

include .mk/GNUmakefile
