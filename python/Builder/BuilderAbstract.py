'''

'''


from abc import ABCMeta, abstractmethod
from Decision import Comparison, Node

class BuilderAbstract():
	
	__metaclass__ = ABCMeta
	
	
	'''
	
	'''
	def __init__(self, Context):
		
		self._Context = None
		self.set_context(Context)
	
	
	'''
	
	'''
	def set_context(self, Context):
		
		self._Context = Context
		

	@abstractmethod
	def build(self):
		
		pass