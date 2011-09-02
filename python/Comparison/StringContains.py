'''
Created on Feb 21, 2011

@author: rfink
'''

from Decision.Comparison.CompareAbstract import CompareAbstract


class StringContains(CompareAbstract):
	
	
	def set_context(self, contextVar):
		
		return super(StringContains, self).set_context(str(contextVar))
	
	
	def set_config(self, configVar):
		
		return super(StringContains, self).set_config(str(configVar))
	
	
	def compare(self):

		return self.contextVar.find(self.configVar) != -1
