'''
Created on Feb 21, 2011

@author: rfink
'''

from Decision.Comparison.CompareAbstract import CompareAbstract


class ListContains(CompareAbstract):


	def set_config(self, configVar):
		
		if not isinstance(configVar, (list, tuple)):
			
			return super(ListContains, self).set_config([configVar]);
		
		return super(ListContains, self).set_config(configVar)
	
	
	def compare(self):

		return self.contextVar in self.configVar
