'''
Created on Feb 21, 2011

@author: rfink
'''

from Decision.Comparison.CompareAbstract import CompareAbstract


class Equal(CompareAbstract):
	
	
	def compare(self):

		return self.contextVar == self.configVar
