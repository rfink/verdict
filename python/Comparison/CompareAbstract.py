'''

'''


from abc import ABCMeta, abstractmethod


class CompareAbstract():
	
	__metaclass__ = ABCMeta
	
	
	def __init__(self, contextVar, configVar):
	
		self.set_context(contextVar)
		self.set_config(configVar)
	
		
	def set_context(self, contextVar):
		
		self.contextVar = contextVar
		return self
	
	
	def set_config(self, configVar):
		
		self.configVar = configVar
		return self
	
	
	@abstractmethod
	def compare(self):
		
		pass
	
		